<?php

namespace CodeFlix\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\CodeFlix\Repositories\CategoryRepository::class, \CodeFlix\Repositories\CategoryRepositoryEloquent::class);
        //:end-bindings:
    }
}
