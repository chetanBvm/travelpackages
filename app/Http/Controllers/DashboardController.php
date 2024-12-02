<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Banner;
use App\Models\ContentManagement;
use App\Models\Country;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Stay;
use App\Models\TravelExperience;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['destination'] = Destination::get()->take(5);
        $data['package'] = Package::with('destination.country')->get()->take(8);
        $data['country'] = Country::get();
        $data['homeBanner'] = ContentManagement::where('type','home_banner')->first();
        $data['homeDestination'] = ContentManagement::where('type','home_destination')->first();
        $data['homeStay'] = ContentManagement::where('type','home_stay')->first();
        $data['homeSection'] = ContentManagement::where('type','home_section')->first();
        $data['homeAirline'] = ContentManagement::where('type','home_airline')->first();
        $data['homePackage'] = ContentManagement::where('type','home_package')->first();
        $data['homeExperience'] = ContentManagement::where('type','home_travelexperience')->first();
        $data['stay'] = Stay::get()->take(5);
        $data['airline'] = Airline::get()->take(6);
        $data['experience'] = TravelExperience::get();
        return view('dashboard', compact('data'));
    }
}
