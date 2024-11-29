<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Itinerary;
use App\Models\Package;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function tourPackages()
    {
        $data['package'] = Package::paginate(20);
        $data['banner'] = Banner::where('type','Packages')->first();
        return view('web.packages.tourpackages', compact('data'));
    }
    /**
     * @return  int $id 
     * use for the getting package detail data 
     */
    public function packageDetail(int $id)
    {
        $packages = Package::findOrFail($id);
        $data['feature'] = Package::get()->take(10);
        $data['itinerary'] = Itinerary::where('package_id',$id)->first();
        return view('web.packages.packagedetail',compact('packages','data'));
    }
}
