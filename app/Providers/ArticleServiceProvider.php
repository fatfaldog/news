<?php

namespace App\Providers;

use App\Services\API\Article\Source\Converter\ArticleConverterInterface;
use App\Services\API\Article\Source\Input\ArticleInputInterface;
use App\Services\API\Article\Source\Output\ArticleOutputInterface;
use Illuminate\Support\ServiceProvider;

class ArticleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ArticleConverterInterface::class
        );

        $this->app->bind(
            ArticleInputInterface::class
        );

        $this->app->bind(
            ArticleOutputInterface::class
        );

    }
}
