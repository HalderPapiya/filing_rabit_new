<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('cache', function () {

    \Artisan::call('cache:clear');
    \Artisan::call('config:cache');

    dd("Cache is cleared");
});


// Route::get('/', function () {


Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
// return view('frontend.index');
// });
Route::prefix('frontend')->name('frontend.')->group(function () {
    // Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('index');
    Route::get('/blog', [App\Http\Controllers\Frontend\HomeController::class, 'blog'])->name('blog');
    Route::get('/blog-details/{id}', [App\Http\Controllers\Frontend\HomeController::class, 'showBlog'])->name('blog.show');
    Route::get('/contact-us', [App\Http\Controllers\Frontend\HomeController::class, 'contactUs'])->name('contact-us');
    Route::get('/about-us', [App\Http\Controllers\Frontend\HomeController::class, 'aboutUs'])->name('about-us');

    // -------------product-----------
    Route::get('/product-list', [App\Http\Controllers\Frontend\ProductController::class, 'index'])->name('all_product.list');
    Route::get('/product', [App\Http\Controllers\Frontend\ProductController::class, 'product'])->name('product');
    Route::get('/product-details/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'showProduct'])->name('product.show');
    Route::get('/subcategory/{id}/product', [App\Http\Controllers\Frontend\ProductController::class, 'product'])->name('product.list');

    Route::get('/privacy-policy', [App\Http\Controllers\Frontend\PolicyController::class, 'privacyPolicy'])->name('privacy-policy');
    Route::get('/terms-and-conditions', [App\Http\Controllers\Frontend\PolicyController::class, 'termsConditions'])->name('terms-and-conditions');
    Route::get('/refund-policy', [App\Http\Controllers\Frontend\PolicyController::class, 'refundPolicy'])->name('refund-policy');
    Route::get('/disclaimer-policy', [App\Http\Controllers\Frontend\PolicyController::class, 'disclaimerPolicy'])->name('disclaimer-policy');
    Route::get('/confidential-statement', [App\Http\Controllers\Frontend\PolicyController::class, 'confidentialStatements'])->name('confidential-statement');

    Route::post('/news_letter', [App\Http\Controllers\Frontend\NewsLetterController::class, 'store'])->name('news_letter');
    Route::get('/consultant', [App\Http\Controllers\Frontend\HomeController::class, 'store'])->name('consultant');
    Route::get('/cart/show', [App\Http\Controllers\Frontend\CartController::class, 'cartView'])->name('cart.show');
});

// -------------------Cart---------------------
Route::prefix('product')->name('product.')->group(function () {
    Route::get('/cart', [App\Http\Controllers\Frontend\CartController::class, 'index'])->name('cart');
    Route::post('/addCart', [App\Http\Controllers\Frontend\CartController::class, 'addCart'])->name('add.cart');
    Route::post('/order', [App\Http\Controllers\Frontend\CartController::class, 'Order'])->name('order');
    Route::post('/coupon/check', [App\Http\Controllers\Frontend\CartController::class, 'couponCheck'])->name('coupon.check');
    // Route::post('/coupon', [App\Http\Controllers\Frontend\CartController::class, 'couponCheck'])->name('coupon.check');
    Route::get('/cart/checkout', [App\Http\Controllers\Frontend\CartController::class, 'cartCheckout'])->name('cart.checkout');
    Route::post('/transaction', [App\Http\Controllers\Frontend\CartController::class, 'transaction'])->name('transaction');
    // Route::post('/cart/coupon/check', [App\Http\Controllers\Frontend\CartController::class, 'couponCheck'])->name('cart.coupon.check');
    // Route::post('/order', [App\Http\Controllers\Frontend\CheckoutController::class, 'store'])->name('order');
});

// ------------------------------------User-----------------------------//
// Route::middleware(['guest:user'])->group(function () {
Route::get('/login_form', [App\Http\Controllers\Auth\LoginController::class, 'loginForm'])->name('login');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('user.registration');
Route::post('/user_login', [App\Http\Controllers\Auth\LoginController::class, 'userLogin'])->name('user.login');
// });


Route::prefix('user')->name('user.')->group(function () {
    Route::middleware(['auth:user'])->group(function () {
        Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/order', [App\Http\Controllers\Frontend\UserController::class, 'order'])->name('order');
        Route::get('/download', [App\Http\Controllers\Frontend\UserController::class, 'download'])->name('download');
        Route::get('/address', [App\Http\Controllers\Frontend\AddressController::class, 'index'])->name('address');
        Route::post('/address-store/{id?}', [App\Http\Controllers\Frontend\AddressController::class, 'store'])->name('address.store');
        Route::get('/account', [App\Http\Controllers\Frontend\UserController::class, 'account'])->name('account');
        Route::post('/change-password', [App\Http\Controllers\Frontend\UserController::class, 'changePassword'])->name('change-password');

        // ------------Business Service---------------------//

        Route::get('/businessService', [App\Http\Controllers\User\BusinessServiceController::class, 'index'])->name('businessService.index');
        Route::get('/businessService/create', [App\Http\Controllers\User\BusinessServiceController::class, 'create'])->name('businessService.create');
        Route::post('/businessService/store', [App\Http\Controllers\User\BusinessServiceController::class, 'store'])->name('businessService.store');
        Route::get('/businessService/edit/{id}', [App\Http\Controllers\User\BusinessServiceController::class, 'edit'])->name('businessService.edit');
        Route::post('/businessService/update', [App\Http\Controllers\User\BusinessServiceController::class, 'update'])->name('businessService.update');
        Route::get('/businessService/{id}/delete', [App\Http\Controllers\User\BusinessServiceController::class, 'destroy'])->name('businessService.delete');
        Route::post('/businessService/updateStatus', [App\Http\Controllers\User\BusinessServiceController::class, 'updateStatus'])->name('businessService.updateStatus');
    });
});



// Route::middleware(['auth:web'])->group(function () {
//     Route::get('user-dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'], function () {
//         return view('user.dashboard');
//     })->name('dashboard');
// });

















// ------------------------User End--------------------------------//
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });
    Route::middleware(['auth:admin'])->group(function () {
        // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'], function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


        Route::get('/profile', [App\Http\Controllers\HomeController::class, 'userProfile'])->name('profile');
        Route::post('/profile', [App\Http\Controllers\HomeController::class, 'userProfileSave'])->name('profile.save');
        // Route::get('user/change/password','HomeController@changePassword')->name('user.changepassword');
        Route::post('admin/change/password', [App\Http\Controllers\HomeController::class, 'updateUserPassword'])->name('changepassword.save');

        //-----------------User----------------

        Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('user.create');
        Route::post('/user/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('user.store');
        Route::get('/user/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('user.update');
        Route::get('/user/delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user.delete');
        Route::post('/user/updateStatus', [App\Http\Controllers\Admin\UserController::class, 'updateStatus'])->name('user.updateStatus');


        //-----------------Category----------------

        Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.create');
        Route::post('/category/store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/category/update', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('category.update');
        Route::get('/category/{id}/delete', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('category.delete');
        Route::post('/category/updateStatus', [App\Http\Controllers\Admin\CategoryController::class, 'updateStatus'])->name('category.updateStatus');

        //-----------------Sub-Category----------------

        Route::get('/subcategory', [App\Http\Controllers\Admin\SubCategoryController::class, 'index'])->name('subcategory.index');
        Route::get('/subcategory/create', [App\Http\Controllers\Admin\SubCategoryController::class, 'create'])->name('subcategory.create');
        Route::post('/subcategory/store', [App\Http\Controllers\Admin\SubCategoryController::class, 'store'])->name('subcategory.store');
        Route::get('/subcategory/edit/{id}', [App\Http\Controllers\Admin\SubCategoryController::class, 'edit'])->name('subcategory.edit');
        Route::post('/subcategory/update', [App\Http\Controllers\Admin\SubCategoryController::class, 'update'])->name('subcategory.update');
        Route::get('/subcategory/{id}/delete', [App\Http\Controllers\Admin\SubCategoryController::class, 'destroy'])->name('subcategory.delete');
        Route::post('/subcategory/updateStatus', [App\Http\Controllers\Admin\SubCategoryController::class, 'updateStatus'])->name('subcategory.updateStatus');

        //-----------------Sub-Sub-Category----------------

        Route::get('/sub-subcategory', [App\Http\Controllers\Admin\SubSubCategoryController::class, 'index'])->name('sub-subcategory.index');
        Route::get('/sub-subcategory/create', [App\Http\Controllers\Admin\SubSubCategoryController::class, 'create'])->name('sub-subcategory.create');
        Route::post('/sub-subcategory/store', [App\Http\Controllers\Admin\SubSubCategoryController::class, 'store'])->name('sub-subcategory.store');
        Route::get('/sub-subcategory/edit/{id}', [App\Http\Controllers\Admin\SubSubCategoryController::class, 'edit'])->name('sub-subcategory.edit');
        Route::post('/sub-subcategory/update', [App\Http\Controllers\Admin\SubSubCategoryController::class, 'update'])->name('sub-subcategory.update');
        Route::get('/sub-subcategory/{id}/delete', [App\Http\Controllers\Admin\SubSubCategoryController::class, 'destroy'])->name('sub-subcategory.delete');
        Route::post('/sub-subcategory/updateStatus', [App\Http\Controllers\Admin\SubSubCategoryController::class, 'updateStatus'])->name('sub-subcategory.updateStatus');

        //-----------------Blog----------------

        Route::get('/blog', [App\Http\Controllers\Admin\BlogController::class, 'index'])->name('blog.index');
        Route::get('/blog/create', [App\Http\Controllers\Admin\BlogController::class, 'create'])->name('blog.create');
        Route::post('/blog/store', [App\Http\Controllers\Admin\BlogController::class, 'store'])->name('blog.store');
        Route::get('/blog/edit/{id}', [App\Http\Controllers\Admin\BlogController::class, 'edit'])->name('blog.edit');
        Route::post('/blog/update', [App\Http\Controllers\Admin\BlogController::class, 'update'])->name('blog.update');
        Route::get('/blog/{id}/delete', [App\Http\Controllers\Admin\BlogController::class, 'destroy'])->name('blog.delete');
        Route::post('/blog/updateStatus', [App\Http\Controllers\Admin\BlogController::class, 'updateStatus'])->name('blog.updateStatus');

        //-----------------WhyUs----------------

        Route::get('/why-us', [App\Http\Controllers\Admin\WhyUsController::class, 'index'])->name('why-us.index');
        Route::get('/why-us/create', [App\Http\Controllers\Admin\WhyUsController::class, 'create'])->name('why-us.create');
        Route::post('/why-us/store', [App\Http\Controllers\Admin\WhyUsController::class, 'store'])->name('why-us.store');
        Route::get('/why-us/edit/{id}', [App\Http\Controllers\Admin\WhyUsController::class, 'edit'])->name('why-us.edit');
        Route::post('/why-us/update', [App\Http\Controllers\Admin\WhyUsController::class, 'update'])->name('why-us.update');
        Route::get('/why-us/{id}/delete', [App\Http\Controllers\Admin\WhyUsController::class, 'destroy'])->name('why-us.delete');
        Route::post('/why-us/updateStatus', [App\Http\Controllers\Admin\WhyUsController::class, 'updateStatus'])->name('why-us.updateStatus');

        // -----------------Business Service----------------

        Route::get('/businessService', [App\Http\Controllers\Admin\BusinessServiceController::class, 'index'])->name('businessService.index');
        Route::get('/businessService/create', [App\Http\Controllers\Admin\BusinessServiceController::class, 'create'])->name('businessService.create');
        Route::post('/businessService/store', [App\Http\Controllers\Admin\BusinessServiceController::class, 'store'])->name('businessService.store');
        Route::get('/businessService/edit/{id}', [App\Http\Controllers\Admin\BusinessServiceController::class, 'edit'])->name('businessService.edit');
        Route::post('/businessService/update', [App\Http\Controllers\Admin\BusinessServiceController::class, 'update'])->name('businessService.update');
        Route::get('/businessService/{id}/delete', [App\Http\Controllers\Admin\BusinessServiceController::class, 'destroy'])->name('businessService.delete');
        Route::post('/businessService/updateStatus', [App\Http\Controllers\Admin\BusinessServiceController::class, 'updateStatus'])->name('businessService.updateStatus');


        //-----------------Package----------------

        Route::get('/package', [App\Http\Controllers\Admin\PackageController::class, 'index'])->name('package.index');
        Route::get('/package/create', [App\Http\Controllers\Admin\PackageController::class, 'create'])->name('package.create');
        Route::post('/package/store', [App\Http\Controllers\Admin\PackageController::class, 'store'])->name('package.store');
        Route::get('/package/edit/{id}', [App\Http\Controllers\Admin\PackageController::class, 'edit'])->name('package.edit');
        Route::post('/package/update', [App\Http\Controllers\Admin\PackageController::class, 'update'])->name('package.update');
        Route::get('/package/{id}/delete', [App\Http\Controllers\Admin\PackageController::class, 'destroy'])->name('package.delete');
        Route::post('/package/updateStatus', [App\Http\Controllers\Admin\PackageController::class, 'updateStatus'])->name('package.updateStatus');

        //-----------------Contact Us----------------

        Route::get('/contact-us', [App\Http\Controllers\Admin\ContactUsController::class, 'index'])->name('contact-us.index');
        Route::get('/contact-us/create', [App\Http\Controllers\Admin\ContactUsController::class, 'create'])->name('contact-us.create');
        Route::post('/contact-us/store', [App\Http\Controllers\Admin\ContactUsController::class, 'store'])->name('contact-us.store');
        Route::get('/contact-us/edit/{id}', [App\Http\Controllers\Admin\ContactUsController::class, 'edit'])->name('contact-us.edit');
        Route::post('/contact-us/update', [App\Http\Controllers\Admin\ContactUsController::class, 'update'])->name('contact-us.update');
        Route::get('/contact-us/{id}/delete', [App\Http\Controllers\Admin\ContactUsController::class, 'destroy'])->name('contact-us.delete');
        Route::post('/contact-us/updateStatus', [App\Http\Controllers\Admin\ContactUsController::class, 'updateStatus'])->name('contact-us.updateStatus');


        //-----------------About us----------------

        Route::get('/about-us', [App\Http\Controllers\Admin\AboutUsController::class, 'index'])->name('about-us.index');
        Route::get('/about-us/create', [App\Http\Controllers\Admin\AboutUsController::class, 'create'])->name('about-us.create');
        Route::post('/about-us/store', [App\Http\Controllers\Admin\AboutUsController::class, 'store'])->name('about-us.store');
        Route::get('/about-us/edit/{id}', [App\Http\Controllers\Admin\AboutUsController::class, 'edit'])->name('about-us.edit');
        Route::post('/about-us/update', [App\Http\Controllers\Admin\AboutUsController::class, 'update'])->name('about-us.update');
        Route::get('/about-us/{id}/delete', [App\Http\Controllers\Admin\AboutUsController::class, 'destroy'])->name('about-us.delete');
        Route::post('/about-us/updateStatus', [App\Http\Controllers\Admin\AboutUsController::class, 'updateStatus'])->name('about-us.updateStatus');

        //-----------------Setting----------------

        Route::get('/setting', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('setting.index');
        Route::get('/setting/create', [App\Http\Controllers\Admin\SettingController::class, 'create'])->name('setting.create');
        Route::post('/setting/store', [App\Http\Controllers\Admin\SettingController::class, 'store'])->name('setting.store');
        Route::get('/setting/edit/{id}', [App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('setting.edit');
        Route::post('/setting/update', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('setting.update');
        Route::get('/setting/{id}/delete', [App\Http\Controllers\Admin\SettingController::class, 'destroy'])->name('setting.delete');
        Route::post('/setting/updateStatus', [App\Http\Controllers\Admin\SettingController::class, 'updateStatus'])->name('setting.updateStatus');

        //-----------------Banner----------------

        Route::get('/banner', [App\Http\Controllers\Admin\BannerController::class, 'index'])->name('banner.index');
        Route::get('/banner/create', [App\Http\Controllers\Admin\BannerController::class, 'create'])->name('banner.create');
        Route::post('/banner/store', [App\Http\Controllers\Admin\BannerController::class, 'store'])->name('banner.store');
        Route::get('/banner/edit/{id}', [App\Http\Controllers\Admin\BannerController::class, 'edit'])->name('banner.edit');
        Route::post('/banner/update', [App\Http\Controllers\Admin\BannerController::class, 'update'])->name('banner.update');
        Route::get('/banner/{id}/delete', [App\Http\Controllers\Admin\BannerController::class, 'destroy'])->name('banner.delete');
        Route::post('/banner/updateStatus', [App\Http\Controllers\Admin\BannerController::class, 'updateStatus'])->name('banner.updateStatus');

        //-----------------Industries Serve----------------

        Route::get('/industries-serve', [App\Http\Controllers\Admin\IndustriesServeController::class, 'index'])->name('industries_serve.index');
        Route::get('/industries-serve/create', [App\Http\Controllers\Admin\IndustriesServeController::class, 'create'])->name('industries_serve.create');
        Route::post('/industries-serve/store', [App\Http\Controllers\Admin\IndustriesServeController::class, 'store'])->name('industries_serve.store');
        Route::get('/industries-serve/edit/{id}', [App\Http\Controllers\Admin\IndustriesServeController::class, 'edit'])->name('industries_serve.edit');
        Route::post('/industries-serve/update', [App\Http\Controllers\Admin\IndustriesServeController::class, 'update'])->name('industries_serve.update');
        Route::get('/industries-serve/{id}/delete', [App\Http\Controllers\Admin\IndustriesServeController::class, 'destroy'])->name('industries_serve.delete');
        Route::post('/industries-serve/updateStatus', [App\Http\Controllers\Admin\IndustriesServeController::class, 'updateStatus'])->name('industries_serve.updateStatus');

        //-----------------Testimonial----------------

        Route::get('/testimonial', [App\Http\Controllers\Admin\TestimonialController::class, 'index'])->name('testimonial.index');
        Route::get('/testimonial/create', [App\Http\Controllers\Admin\TestimonialController::class, 'create'])->name('testimonial.create');
        Route::post('/testimonial/store', [App\Http\Controllers\Admin\TestimonialController::class, 'store'])->name('testimonial.store');
        Route::get('/testimonial/edit/{id}', [App\Http\Controllers\Admin\TestimonialController::class, 'edit'])->name('testimonial.edit');
        Route::post('/testimonial/update', [App\Http\Controllers\Admin\TestimonialController::class, 'update'])->name('testimonial.update');
        Route::get('/testimonial/{id}/delete', [App\Http\Controllers\Admin\TestimonialController::class, 'destroy'])->name('testimonial.delete');
        Route::post('/testimonial/updateStatus', [App\Http\Controllers\Admin\TestimonialController::class, 'updateStatus'])->name('testimonial.updateStatus');

        //-----------------Coupon----------------

        Route::get('/coupon', [App\Http\Controllers\Admin\CouponController::class, 'index'])->name('coupon.index');
        Route::get('/coupon/create', [App\Http\Controllers\Admin\CouponController::class, 'create'])->name('coupon.create');
        Route::post('/coupon/store', [App\Http\Controllers\Admin\CouponController::class, 'store'])->name('coupon.store');
        Route::get('/coupon/edit/{id}', [App\Http\Controllers\Admin\CouponController::class, 'edit'])->name('coupon.edit');
        Route::post('/coupon/update', [App\Http\Controllers\Admin\CouponController::class, 'update'])->name('coupon.update');
        Route::get('/coupon/{id}/delete', [App\Http\Controllers\Admin\CouponController::class, 'destroy'])->name('coupon.delete');
        Route::post('/coupon/updateStatus', [App\Http\Controllers\Admin\CouponController::class, 'updateStatus'])->name('coupon.updateStatus');

        //-----------------Product----------------

        Route::get('/product', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('product.index');
        Route::get('/product/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('product.create');
        Route::post('/product/store', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('product.store');
        Route::get('/product/edit/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('product.edit');
        Route::post('/product/update', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('product.update');
        Route::get('/product/{id}/delete', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('product.delete');
        Route::post('/product/updateStatus', [App\Http\Controllers\Admin\ProductController::class, 'updateStatus'])->name('product.updateStatus');

        //-----------------Description----------------

        Route::get('/description', [App\Http\Controllers\Admin\DescriptionController::class, 'index'])->name('description.index');
        Route::get('/description/create', [App\Http\Controllers\Admin\DescriptionController::class, 'create'])->name('description.create');
        Route::post('/description/store', [App\Http\Controllers\Admin\DescriptionController::class, 'store'])->name('description.store');
        Route::get('/description/edit/{id}', [App\Http\Controllers\Admin\DescriptionController::class, 'edit'])->name('description.edit');
        Route::post('/description/update', [App\Http\Controllers\Admin\DescriptionController::class, 'update'])->name('description.update');
        Route::get('/description/{id}/delete', [App\Http\Controllers\Admin\DescriptionController::class, 'destroy'])->name('description.delete');
        Route::post('/description/updateStatus', [App\Http\Controllers\Admin\DescriptionController::class, 'updateStatus'])->name('description.updateStatus');

        //-----------------Process----------------

        Route::get('/process', [App\Http\Controllers\Admin\ProcessController::class, 'index'])->name('process.index');
        Route::get('/process/create', [App\Http\Controllers\Admin\ProcessController::class, 'create'])->name('process.create');
        Route::post('/process/store', [App\Http\Controllers\Admin\ProcessController::class, 'store'])->name('process.store');
        Route::get('/process/edit/{id}', [App\Http\Controllers\Admin\ProcessController::class, 'edit'])->name('process.edit');
        Route::post('/process/update', [App\Http\Controllers\Admin\ProcessController::class, 'update'])->name('process.update');
        Route::get('/process/{id}/delete', [App\Http\Controllers\Admin\ProcessController::class, 'destroy'])->name('process.delete');
        Route::post('/process/updateStatus', [App\Http\Controllers\Admin\ProcessController::class, 'updateStatus'])->name('process.updateStatus');
    });
});










// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::middleware(['guest:admin'])->group(function () {
//         Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
//         Route::post('/login', [LoginController::class, 'login']);
//     });
//     Route::middleware(['auth:admin'])->group(function () {
//         Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//         Route::get('dashboard', function () {
//             return view('admin.dashboard');
//         })->name('admin.dashboard');
//     });

//     Route::post('/logout', [LoginController::class, 'login']);
//     //-----------------Interest---------------------



// });