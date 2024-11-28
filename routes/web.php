<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\PackagesController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController as ControllersDashboardController;
use App\Http\Controllers\PackagesController as ControllersPackagesController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//cache clear routes
Route::get('/clear-cache', function () {
    // Running route:clear Artisan command
    Artisan::call('optimize:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    return 'Route cache cleared!';
});

//migrate command
Route::get('/migrate', function () {
    Artisan::call('migrate');

    return "Specific migration executed successfully!";
});

//Admin
Route::group(['prefix' => 'admin'], function () {

    Route::get('',[AuthController::class,'index']);
    Route::get('login', [AuthController::class, 'index'])->name('admin.login');
    Route::post('check-login', [AuthController::class, 'checkLogin'])->name('admin.login.check');

    Route::group(['middleware' => ['auth', 'verified']], function () {

        //Admin logout
        Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

        //dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        //User
        Route::resource('user', UserController::class);

        //Packages
        Route::resource('package', PackagesController::class);

        //Destination
        Route::resource('destination', DestinationController::class);

        //Promotion
        Route::resource('promotion', PromotionController::class);

        //Banner
        Route::resource('banner', BannerController::class);
    });
});

//Web

Route::get('/',[ControllersDashboardController::class,'index'])->name('dashboard');

//Packages
Route::get('tour-packages',[ControllersPackagesController::class,'tourPackages'])->name('web.packages');
