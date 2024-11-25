<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\PackagesController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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

//Admin
Route::group(['prefix' => 'admin','middelware'=> ['auth','verified']], function () {
   
    //dashboard
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.index');

    //User
    Route::resource('user', UserController::class);
    
    //Packages
    Route::resource('package',PackagesController::class);

    //Destination
    Route::resource('destination',DestinationController::class);

    //Promotion
    Route::resource('promotion',PromotionController::class);

    //Banner
    Route::resource('banner',BannerController::class);
});