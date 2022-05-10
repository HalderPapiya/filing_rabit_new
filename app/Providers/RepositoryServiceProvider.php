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
use App\Contracts\BannerContract;
use App\Repositories\BannerRepository;
use App\Contracts\IndustriesServeContract;
use App\Repositories\IndustriesServeRepository;
use App\Contracts\TestimonialContract;
use App\Repositories\TestimonialRepository;
use App\Contracts\SubSubCategoryContract;
use App\Repositories\SubSubCategoryRepository;
use App\Contracts\ProductContract;
use App\Repositories\ProductRepository;
use App\Contracts\DescriptionContract;
use App\Repositories\DescriptionRepository;
use App\Contracts\ProcessContract;
use App\Repositories\ProcessRepository;
use App\Contracts\NewsLetterContract;
use App\Repositories\NewsLetterRepository;
use App\Contracts\ConsultantContract;
use App\Repositories\ConsultantRepository;
use App\Contracts\CartContract;
use App\Repositories\CartRepository;
use App\Contracts\OrderContract;
use App\Repositories\OrderRepository;
use App\Contracts\CheckoutContract;
use App\Repositories\CheckoutRepository;
use App\Contracts\AddressContract;
use App\Repositories\AddressRepository;

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
        BannerContract::class =>  BannerRepository::class,
        IndustriesServeContract::class =>  IndustriesServeRepository::class,
        TestimonialContract::class =>  TestimonialRepository::class,
        SubSubCategoryContract::class =>  SubSubCategoryRepository::class,
        ProductContract::class =>  ProductRepository::class,
        DescriptionContract::class =>  DescriptionRepository::class,
        ProcessContract::class =>  ProcessRepository::class,
        NewsLetterContract::class =>  NewsLetterRepository::class,
        ConsultantContract::class =>  ConsultantRepository::class,
        CartContract::class =>  CartRepository::class,
        OrderContract::class =>  OrderRepository::class,
        CheckoutContract::class =>  CheckoutRepository::class,
        AddressContract::class =>  AddressRepository::class,
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