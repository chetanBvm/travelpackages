<?php

namespace App\Http\Controllers;


use App\Models\ContentManagement;


class PagesController extends Controller
{
    public function aboutUs()
    {
        $data['banner'] = ContentManagement::where('type', 'about_banner')->first();
        $data['bannerwelcome'] = ContentManagement::where('type', 'about_welcome')->first();
        $data['service'] = ContentManagement::where('type', 'about_travelservice')->first();
        $data['servicecontent'] = ContentManagement::where('type', 'about_travelservicecontent')->get();
        $data['trackrecord'] = ContentManagement::where('type', 'about_travelrecord')->first();
        $data['trackwrapper'] = ContentManagement::where('type', 'about_travelrecordwrapper')->get();
        $data['social_link'] = ContentManagement::where('type', 'home_topbar')->first();
        $data['social_links'] = ContentManagement::where('type', 'home_topbar')->where('keywords','!=','main_title')->get();
        return view('web.pages.aboutus', compact('data'));
    }

    public function contactUs()
    {
        $data['social_link'] = ContentManagement::where('type', 'home_topbar')->first();
        $data['social_links'] = ContentManagement::where('type', 'home_topbar')->where('keywords','!=','main_title')->get();
        return view('web.pages.contactus',compact('data'));
    }

    public function blogs()
    {
        $data['social_link'] = ContentManagement::where('type', 'home_topbar')->first();
        $data['social_links'] = ContentManagement::where('type', 'home_topbar')->where('keywords','!=','main_title')->get();
        return view('web.pages.blog',compact('data'));
    }

    public function termAndCondition()
    {
        $data['social_link'] = ContentManagement::where('type', 'home_topbar')->first();
        $data['social_links'] = ContentManagement::where('type', 'home_topbar')->where('keywords','!=','main_title')->get();
        return view('web.pages.termsandcondition',compact('data'));
    }

    public function privacyPolicy()
    {
        $data['social_link'] = ContentManagement::where('type', 'home_topbar')->first();
        $data['social_links'] = ContentManagement::where('type', 'home_topbar')->where('keywords','!=','main_title')->get();
        return view('web.pages.privacypolicy',compact('data'));
    }
}
