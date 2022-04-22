<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\UserContract;
use App\Repositories\UserRepository;
use App\Contracts\CategoryContract;
use App\Repositories\CategoryRepository;
use App\Contracts\SubCategoryContract;
use App\Repositories\SubCategoryRepository;
use App\Contracts\BlogContract;
use App\Repositories\BlogRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        UserContract::class =>  UserRepository::class,
        CategoryContract::class =>  CategoryRepository::class,
        SubCategoryContract::class =>  SubCategoryRepository::class,
        BlogContract::class =>  BlogRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}