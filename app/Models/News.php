<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class News extends Article
{
    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->typename = 'news';
        });

        static::addGlobalScope('typename', function (Builder $builder) {
            $builder->where('typename', 'news');
        });

    }
}
