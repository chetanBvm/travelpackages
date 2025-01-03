<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Banner;
use App\Models\ContentManagement;
use App\Models\Country;
use App\Models\Destination;
use App\Models\Package;
use App\Models\PackageType;
use App\Models\SeoManagement;
use App\Models\Setting;
use App\Models\Stay;
use App\Models\TravelExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $data['destination'] = Destination::where('status','Active')->get()->take(5);
        $data['destinations'] = Destination::with('country')->where('status','Active')->get();
        $data['package'] = Package::with('destination.country')->where('status','Active')->get()->take(8);
        $data['country'] = Country::get();
        $data['homeBanner'] = ContentManagement::where('type', 'home_banner')->first();
        $data['homeDestination'] = ContentManagement::where('type', 'home_destination')->first();
        $data['homeStay'] = ContentManagement::where('type', 'home_stay')->first();
        $data['homeSection'] = ContentManagement::where('type', 'home_section')->first();
        $data['homeAirline'] = ContentManagement::where('type', 'home_airline')->first();
        $data['homePackage'] = ContentManagement::where('type', 'home_package')->first();
        $data['homeExperience'] = ContentManagement::where('type', 'home_travelexperience')->first();
        $data['banner'] = Banner::where('type', 'Home')->get();
        $data['stay'] = Stay::where('status','Active')->get()->take(5);
        $data['airline'] = Airline::where('status','Active')->get()->take(6);
        $data['experience'] = TravelExperience::get();
        $data['packageType'] = PackageType::get();
        $data['social_link'] = ContentManagement::where('type', 'home_topbar')->first();
        $packageTypes =  PackageType::with('subpackage')->whereNUll('parent_id')->get();
        $pageSEO = SeoManagement::where('page_id','1')->first();
        $settings = Setting::where('type','logo')->value('image');
        $settingContact = Setting::where('type','contact')->first();
        return view('dashboard', compact('data', 'packageTypes','pageSEO','settings','settingContact'));
    }

    /**
     * Function is used for the on home dashboard filter the packages 
     */
    public function homeFilter(Request $request)
    {
        $destination  = $request->destination;
        $month = $request->departure_month;
        $days = $request->departure_days;
        $packageType = $request->package_type;

        //Query the database filter
        $packages = Package::query();

        if ($destination != 'all') {
            $packages->where('destination_id', $destination);
        }

        if ($days != 'all') {
            [$minDays, $maxDays] = explode('-', $days . '-');
            if ($minDays) {
                $packages->where('days', '>=', $minDays);
            }
            if ($maxDays) {
                $packages->where('days', '<=', $maxDays);
            }
        }

        if ($month != 'all') {
            $packages->whereJsonContains('departure_month',  $month);
        }

        if ($packageType != 'all') {
            $packages->where('packagetype_id', $packageType);
        }

        $filteredPackages = $packages->where('status','Active')->get();

        $data['country'] = Country::get();
        $data['packageType'] = PackageType::all();
        $data['social_link'] = ContentManagement::where('type', 'home_topbar')->first();
        $data['destination'] = Destination::with('country')->get();
        $packageTypes =  PackageType::with('subpackage')->whereNUll('parent_id')->get();
        $settings = Setting::where('type','logo')->value('image');
        $settingContact = Setting::where('type','contact')->first();
        $data['packageType'] = PackageType::get();
        $pageSEO = SeoManagement::where('page_id','3')->first();
        return view('web.packages.tourpackages', compact('pageSEO','filteredPackages', 'data','packageTypes','settings','settingContact'));
    }

    //sortest packages
    public function sortPackages(Request $request)
    {
        $sort = $request->get('sort'); // Get sort parameter
        $price = $request->price;

        $packages = Package::query();

        if ($sort === 'shortest') {
            $packages = $packages->orderBy('days', 'asc'); // Sort by days descending
        } elseif ($sort === 'longest') {
            $packages = $packages->orderBy('days', 'desc'); // Sort by days ascending
        }

        if ($price === 'shortest') {
            $packages = $packages->orderBy('price', 'asc');
        } elseif ($price === 'highest') {
            $packages = $packages->orderBy('price', 'desc');
        }

        $packageList = $packages->with('destination.country')->where('status','Active')->get();

        // Return a partial view or JSON response for AJAX
        return view('web.partial.packages', compact('packageList'));
    }

    public function getPackageDetailCityWies($id)
    {
        $filteredPackages = Package::where('destination_id', $id)->where('status','Active')->get();
        $data['packageType'] = PackageType::all();
        $data['social_link'] = ContentManagement::where('type', 'home_topbar')->first();
        $data['destination'] = Destination::with('country')->get();
        $packageTypes =  PackageType::with('subpackage')->whereNUll('parent_id')->get();
        $settings = Setting::where('type','logo')->value('image');
        $settingContact = Setting::where('type','contact')->first();
        $data['packageType'] = PackageType::get();
        return view('web.packages.tourpackages', compact('filteredPackages', 'data','packageTypes','settings','settingContact'));
    }

    public function getPackageDetails($id)
    {
        $data['packageTypes'] = PackageType::with('subpackage')->findOrFail($id);
        $data['package']= Package::where('packagetype_id', $id)->where('status','Active')->get();
        $data['destination'] = Destination::with('country')->get();
        $data['social_link'] = ContentManagement::where('type', 'home_topbar')->first();
      
        $packageTypes =  PackageType::with('subpackage')->whereNUll('parent_id')->get();
        $settings = Setting::where('type','logo')->value('image');
        $settingContact = Setting::where('type','contact')->first();
        $data['packageType'] = PackageType::get();
        $pageSEO = SeoManagement::where('page_id','3')->first();
        return view('web.packages.tourpackages', compact('data','pageSEO','packageTypes','settings','settingContact'))->with('filteredPackages', collect());
    }
}
