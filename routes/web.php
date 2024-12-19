<?php

use App\Http\Controllers\Admin\AccommodationController;
use App\Http\Controllers\Admin\AirlinesController;
use App\Http\Controllers\Admin\AirportController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BookingsController;
use App\Http\Controllers\Admin\ContentManagementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartureCityController;
use App\Http\Controllers\Admin\DepartureFlightsController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\ExclusionsController;
use App\Http\Controllers\Admin\InclusionsController;
use App\Http\Controllers\Admin\ItineraryController;
use App\Http\Controllers\Admin\PackageImageController;
use App\Http\Controllers\Admin\PackageReviewsController;
use App\Http\Controllers\Admin\PackagesController;
use App\Http\Controllers\Admin\PackageTypeController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\StayController;
use App\Http\Controllers\Admin\TravelExperienceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BookingController;
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
        Route::resource('package-image', PackageImageController::class);

        //Package Reviews
        Route::resource('package-review',PackageReviewsController::class);

        //Package Type
        Route::resource('package-type', PackageTypeController::class);

        //Departure Flights
        Route::resource('departure-flights',DepartureFlightsController::class);

        //Departure City
        Route::resource('departure-city',DepartureCityController::class);

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
        Route::resource('inclusion', InclusionsController::class);

        //Exclusion
        Route::resource('exclusion', ExclusionsController::class);
        
        //Airport
        Route::resource('airport', AirportController::class);

        //Bookings
        Route::resource('bookings', BookingsController::class);
        Route::post('bookings/{id}',[BookingsController::class,'update'])->name('admin.bookings.update');

        //Content Management
        Route::group(['prefix' => 'content'], function () {
            //home banner
            Route::get('home-banner', [ContentManagementController::class, 'homeBanner'])->name('home-banner');
            Route::post('home-banner/save', [ContentManagementController::class, 'homeBannerSave'])->name('home-banner.save');
            //home destination
            Route::get('home-destination', [ContentManagementController::class, 'homeDestination'])->name('home.destination');
            Route::post('home-destination/save', [ContentManagementController::class, 'homeDestinationSave'])->name('home-destination.save');
            //home stay
            Route::get('home-stay', [ContentManagementController::class, 'homeStay'])->name('home.stay');
            Route::post('home-stay/save', [ContentManagementController::class, 'homeStaySave'])->name('home-stay.save');
            //home section
            Route::get('home-section', [ContentManagementController::class, 'homeSection'])->name('home.section');
            Route::post('home-section/save', [ContentManagementController::class, 'homeSectionSave'])->name('home-section.save');
            //home airline
            Route::get('home-airline', [ContentManagementController::class, 'homeAirline'])->name('home.airline');
            Route::post('home-airline/save', [ContentManagementController::class, 'homeAirlineSave'])->name('home-airline.save');
            //home package
            Route::get('home-package', [ContentManagementController::class, 'homePackage'])->name('home.package');
            Route::post('home-package/save', [ContentManagementController::class, 'homePackageSave'])->name('home-package.save');
            //home travel experience
            Route::get('home-travelexperience', [ContentManagementController::class, 'homeTravelExperience'])->name('home.travelExperience');
            Route::post('home-travelexperience/save', [ContentManagementController::class, 'homeTravelExperienceSave'])->name('home-experience.save');
            
            //home Top Bar
            Route::get('home-topbar', [ContentManagementController::class, 'homeTopBar'])->name('home.topbar');
            Route::post('home-topbar/save', [ContentManagementController::class, 'homeTopBarSave'])->name('home-topbar.save');
            
            //about banner
            Route::get('about-banner', [ContentManagementController::class, 'aboutBanner'])->name('aboutbanner');
            Route::post('about-banner/save', [ContentManagementController::class, 'aboutBannerSave'])->name('aboutbanner.save');

            //about welcome
            Route::get('about-welcome', [ContentManagementController::class, 'aboutWelcome'])->name('about.welcome');
            Route::post('about-welcome/save', [ContentManagementController::class, 'aboutWelcomeSave'])->name('aboutwelcome.save');

            //about travel service
            Route::get('about-travelservice', [ContentManagementController::class, 'aboutTravelService'])->name('about-travelservice');
            Route::post('about-travelservice/save', [ContentManagementController::class, 'aboutTravelServiceSave'])->name('about-travelservice.save');

            //about travel service content
            Route::get('about-travelservice-content', [ContentManagementController::class, 'aboutTravelserviceContent'])->name('about-travelservicecontent');
            Route::post('about-travelservice-content/save', [ContentManagementController::class, 'aboutTravelserviceContentSave'])->name('about-travelservicecontent.save');
            //about Track Record
            Route::get('about-trackrecord', [ContentManagementController::class, 'aboutTravelRecord'])->name('about-trackrecord');
            Route::post('about-trackrecord/save', [ContentManagementController::class, 'aboutTravelRecordSave'])->name('about-trackrecord.save');

            //about Track Record wrapper
            Route::get('about-trackrecordwrapper', [ContentManagementController::class, 'aboutTravelRecordWrapper'])->name('about-trackrecordwrapper');
            Route::post('about-trackrecordwrapper/save', [ContentManagementController::class, 'aboutTravelRecordWrapperSave'])->name('about-trackrecordwrapper.save');
        });
    });
});

//Web

Route::get('/', [ControllersDashboardController::class, 'index'])->name('dashboard');
Route::get('all-packages',[ControllersDashboardController::class,'homeFilter'])->name('dashboard.filter');
//Packages
Route::get('tour-packages', [ControllersPackagesController::class, 'tourPackages'])->name('web.packages');
Route::get('package-detail/{id}', [ControllersPackagesController::class, 'packageDetail'])->name('web.packageDetails');
Route::get('/download-pdf/{id}', [ControllersPackagesController::class, 'downloadPdf'])->name('download.pdf');
Route::post('/departure-flights/year', [ControllersPackagesController::class, 'getDepartureFlight'])->name('departure-flights.year-details');

Route::post('departure-flights/get-flights-by-city-and-month', [ControllersPackagesController::class, 'getFlightsByCityAndMonth']);

Route::get('get-departure-dates',[ControllersPackagesController::class,'getDepartureFlightDates']);

Route::get('get-departure-dates-airport',[ControllersPackagesController::class,'getDepartureDatesAirport']);

//Pages
Route::get('about-us', [PagesController::class, 'aboutUs'])->name('pages.about');
Route::get('contact-us', [PagesController::class, 'contactUs'])->name('pages.contactus');
Route::get('blog', [PagesController::class, 'blogs'])->name('pages.blog');
Route::get('terms-and-condition', [PagesController::class, 'termAndCondition'])->name('pages.terms');
Route::get('privacy-policy', [PagesController::class, 'privacyPolicy'])->name('pages.policy');

//Booking 
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
