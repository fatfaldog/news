<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PaginationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(
            \Nuwave\Lighthouse\Pagination\PaginationServiceProvider::class
        );

    }
}
