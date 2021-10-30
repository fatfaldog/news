<?php
namespace App\Models;

class News extends Article
{
    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->typename = 'news';
        });

    }
}
