<?php

namespace App\Http\Controllers;


use App\Models\ContentManagement;


class PagesController extends Controller
{
    public function aboutUs(){
        $data['banner'] = ContentManagement::where('type','about_banner')->first();
        $data['bannerwelcome'] = ContentManagement::where('type','about_welcome')->first();
        $data['service'] = ContentManagement::where('type','about_travelservice')->first();
        $data['servicecontent'] = ContentManagement::where('type','about_travelservicecontent')->get();
        $data['trackrecord'] = ContentManagement::where('type','about_travelrecord')->first();
        $data['trackwrapper']= ContentManagement::where('type','about_travelrecordwrapper')->get();
        return view('web.pages.aboutus',compact('data'));
    }
}
