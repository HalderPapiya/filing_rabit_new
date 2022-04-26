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


Route::get('/', function () {

    return view('frontend.index');
});
Route::prefix('frontend')->name('frontend.')->group(function () {
    Route::get('/blog', [App\Http\Controllers\Frontend\HomeController::class, 'blog'])->name('blog');
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });
    Route::middleware(['auth:admin'])->group(function () {
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