<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Package;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data['destination'] = Destination::get()->take(5);
        $data['package'] = Package::get()->take(8);
        return view('dashboard',compact('data'));
    }
}
