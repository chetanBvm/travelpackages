<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function tourPackages(){
        $data['package'] = Package::paginate();
        return view('web.packages.tourpackages',compact('data'));
    }
}
