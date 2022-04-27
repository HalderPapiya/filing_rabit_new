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
use App\Contracts\WhyUsContract;
use App\Repositories\WhyUsRepository;
use App\Contracts\BusinessServiceContract;
use App\Repositories\BusinessServiceRepository;
use App\Contracts\PackageContract;
use App\Repositories\PackageRepository;
use App\Contracts\ContactUsContract;
use App\Repositories\ContactUsRepository;
use App\Contracts\AboutUsContract;
use App\Repositories\AboutUsRepository;
use App\Contracts\SettingContract;
use App\Repositories\SettingRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        UserContract::class =>  UserRepository::class,
        CategoryContract::class =>  CategoryRepository::class,
        SubCategoryContract::class =>  SubCategoryRepository::class,
        BlogContract::class =>  BlogRepository::class,
        WhyUsContract::class =>  WhyUsRepository::class,
        BusinessServiceContract::class =>  BusinessServiceRepository::class,
        PackageContract::class =>  PackageRepository::class,
        ContactUsContract::class =>  ContactUsRepository::class,
        AboutUsContract::class =>  AboutUsRepository::class,
        SettingContract::class =>  SettingRepository::class,
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