<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Banner;
use App\Models\Country;
use App\Models\Itinerary;
use App\Models\Package;
use App\Models\PackageImages;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function tourPackages()
    {
        $data['package'] = Package::with('destination.country')->paginate(20);
        $data['banner'] = Banner::where('type','Packages')->first();
        return view('web.packages.tourpackages', compact('data'));
    }
    /**
     * @return  int $id 
     * use for the getting package detail data 
     */
    public function packageDetail(int $id)
    {
        $packages = Package::with('images')->findOrFail($id);
        $data['packageImages'] = PackageImages::where('package_id',$id)->get();
        $data['packages'] = Package::get()->take(3);
        $data['feature'] = Package::get()->take(10);
        $data['itinerary'] = Itinerary::where('package_id',$id)->first();
        $data['airport'] = Airport::get();
        $data['country'] = Country::get();
        return view('web.packages.packagedetail',compact('packages','data'));
    }
}
