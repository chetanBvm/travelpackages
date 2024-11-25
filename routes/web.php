<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\PackagesController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin
Route::group(['prefix' => 'admin','middelware'=> ['auth']], function () {
   
    //dashboard
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.index');

    //User
    Route::resource('user', UserController::class);
    
    //Packages
    Route::resource('package',PackagesController::class);

    //Destination
    Route::resource('destination',DestinationController::class);
});