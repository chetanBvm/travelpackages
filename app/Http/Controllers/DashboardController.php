<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Banner;
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
        $data['package'] = Package::get()->take(8);
        $data['country'] = Country::get();
        $data['banner'] = Banner::first();
        $data['stay'] = Stay::get()->take(5);
        $data['airline'] = Airline::get()->take(6);
        $data['experience'] = TravelExperience::get();
        return view('dashboard', compact('data'));
    }
}
