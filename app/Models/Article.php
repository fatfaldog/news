<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

/**
 * This is the model class for table "{{%articles}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $source
 * @property integer $author_id
 * @property string $description
 * @property string $url
 * @property string $urlToImage
 * @property string $publishedAt
 * @property string $content
 * @property integer $category_id
 * @property string $typename
 * @property-read Category $category
 * @property-read Author $author
 */
class Article extends Model
{
    protected $table = 'articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'source',
        'author',
        'description',
        'url',
        'urlToImage',
        'publishedAt',
        'content',
        'category_id',
        'typename',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];


    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->typename = 'article';
        });

    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function scopeSearchText($query, $param)
    {
        return $query->where(function ($query) use ($param) {
            $query
                ->orWhere('title', 'like', '%' . $param . '%')
                ->orWhere('content', 'like', '%' . $param . '%')
                ->orWhere('description', 'like', '%' . $param . '%');

            $query->orWhereHas('author', function ($q) use ($param) {
                $q->where('name', 'like', '%' . $param . '%');
            });

            $query->orWhereHas('category', function ($q) use ($param) {
                $q->where('name', 'like', '%' . $param . '%');
            });
        });
    }

    public function scopeFromDate($query, $param)
    {
        return $query->where('publishedAt', '>=', $param);
    }

    public function scopeToDate($query, $param)
    {
        return $query->where('publishedAt', '<=', $param);
    }

    public function scopeTypeName($query, $param)
    {
        return $query->where('typename', $param);
    }
}
