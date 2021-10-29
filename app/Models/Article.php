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
 * @property string $author
 * @property string $description
 * @property string $url
 * @property string $urlToImage
 * @property string $publishedAt
 * @property string $content
 * @property integer $category_id
 * @property string $article_type
 * @property-read Category $category
 */
class Article extends Model
{

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
        'article_type',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }



}
