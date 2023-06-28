<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\Interfaces\LanguageRepository::class, \App\Repositories\Eloquents\LanguageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\OptionRepository::class, \App\Repositories\Eloquents\OptionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\CategoryRepository::class, \App\Repositories\Eloquents\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\CategoryDetailRepository::class, \App\Repositories\Eloquents\CategoryDetailRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\PostRepository::class, \App\Repositories\Eloquents\PostRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\PostDetailRepository::class, \App\Repositories\Eloquents\PostDetailRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ContactRepository::class, \App\Repositories\Eloquents\ContactRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\OptionDetailRepository::class, \App\Repositories\Eloquents\OptionDetailRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\UserRepository::class, \App\Repositories\Eloquents\UserRepositoryEloquent::class);
        //:end-bindings:
    }
}
