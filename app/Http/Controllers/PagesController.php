<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function aboutUs(){
        $banner = Banner::where('type','About')->first();
        return view('web.pages.aboutus',compact('banner'));
    }
}
