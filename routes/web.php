<?php

use App\Http\Controllers\Admin\AirlinesController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ContentManagementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\InclusionsController;
use App\Http\Controllers\Admin\ItineraryController;
use App\Http\Controllers\Admin\PackageImageController;
use App\Http\Controllers\Admin\PackagesController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\StayController;
use App\Http\Controllers\Admin\TravelExperienceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController as ControllersDashboardController;
use App\Http\Controllers\PackagesController as ControllersPackagesController;
use App\Http\Controllers\PagesController;
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

    Route::get('', [AuthController::class, 'index']);
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

        //Package Image
        Route::resource('package-image',PackageImageController::class);

        //Destination
        Route::resource('destination', DestinationController::class);

        //Promotion
        Route::resource('promotion', PromotionController::class);

        //Banner
        Route::resource('banner', BannerController::class);

        //Stay
        Route::resource('stay', StayController::class);

        //Airline
        Route::resource('airline', AirlinesController::class);

        //Travel Experience
        Route::resource('travel-experience', TravelExperienceController::class);

        //Itinerary
        Route::resource('itinerary', ItineraryController::class);
        
        //Inclusion
        Route::resource('inclusion',InclusionsController::class);

        //Content Management
        Route::group(['prefix' => 'content'],function(){
            Route::get('home-banner',[ContentManagementController::class,'homeBanner'])->name('home-banner');
            Route::post('home-banner/save',[ContentManagementController::class,'homeBannerSave'])->name('home-banner.save');

            Route::get('home-destination',[ContentManagementController::class,'homeDestination'])->name('home.destination');
            Route::post('home-destination/save',[ContentManagementController::class,'homeDestinationSave'])->name('home-destination.save');

            Route::get('home-stay',[ContentManagementController::class,'homeStay'])->name('home.stay');
            Route::post('home-stay/save',[ContentManagementController::class,'homeStaySave'])->name('home-stay.save');

            Route::get('home-section',[ContentManagementController::class,'homeSection'])->name('home.section');
            Route::post('home-section/save',[ContentManagementController::class,'homeSectionSave'])->name('home-section.save');

            Route::get('home-airline',[ContentManagementController::class,'homeAirline'])->name('home.airline');
            Route::post('home-airline/save',[ContentManagementController::class,'homeAirlineSave'])->name('home-airline.save');

            Route::get('home-package',[ContentManagementController::class,'homePackage'])->name('home.package');
            Route::post('home-package/save',[ContentManagementController::class,'homePackageSave'])->name('home-package.save');

            Route::get('home-travelexperience',[ContentManagementController::class,'homeTravelExperience'])->name('home.travelExperience');
            Route::post('home-travelexperience/save',[ContentManagementController::class,'homeTravelExperienceSave'])->name('home-experience.save');
        });
    });
});

//Web

Route::get('/', [ControllersDashboardController::class, 'index'])->name('dashboard');

//Packages
Route::get('tour-packages', [ControllersPackagesController::class, 'tourPackages'])->name('web.packages');
Route::get('package-detail/{id}', [ControllersPackagesController::class, 'packageDetail'])->name('web.packageDetails');


//Pages
Route::get('about-us', [PagesController::class, 'aboutUs'])->name('pages.about');
