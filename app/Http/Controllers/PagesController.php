<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\ContentManagement;
use App\Models\PackageType;
use App\Models\SeoManagement;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $packageTypes =  PackageType::with('subpackage')->whereNUll('parent_id')->get();
        $settings = Setting::where('type','logo')->value('image');
        $settingContact = Setting::where('type','contact')->first();
        $data['packageType'] = PackageType::whereNotNUll('parent_id')->get();
        $pageSEO = SeoManagement::where('page_id','2')->first();
        return view('web.pages.aboutus', compact('data','packageTypes','settings','settingContact','pageSEO'));
    }

    public function contactUs()
    {
        $data['social_link'] = ContentManagement::where('type', 'home_topbar')->first();        
        $packageTypes =  PackageType::with('subpackage')->whereNUll('parent_id')->get();
        $settings = Setting::where('type','logo')->value('image');
        $settingContact = Setting::where('type','contact')->first();
        $data['packageType'] = PackageType::whereNotNUll('parent_id')->get();
        $contactUs = ContentManagement::where('type','contactus')->first();
        return view('web.pages.contactus',compact('data','packageTypes','settings','settingContact','contactUs'));
    }

    public function blogs()
    {
        $data['social_link'] = ContentManagement::where('type', 'home_topbar')->first();      
        $packageTypes =  PackageType::with('subpackage')->whereNUll('parent_id')->get();
        $settings = Setting::where('type','logo')->value('image');
        $settingContact = Setting::where('type','contact')->first();
        $data['packageType'] = PackageType::whereNotNUll('parent_id')->get();
        return view('web.pages.blog',compact('data','packageTypes','settings','settingContact'));

    }

    public function termAndCondition()
    {
        $data['social_link'] = ContentManagement::where('type', 'home_topbar')->first();      
        $packageTypes =  PackageType::with('subpackage')->whereNUll('parent_id')->get();
        $settings = Setting::where('type','logo')->value('image');
        $settingContact = Setting::where('type','contact')->first();
        $data['packageType'] = PackageType::whereNotNUll('parent_id')->get();
        return view('web.pages.termsandcondition',compact('data','packageTypes','settings','settingContact'));
    }

    public function privacyPolicy()
    {
        $data['social_link'] = ContentManagement::where('type', 'home_topbar')->first();   
        $packageTypes =  PackageType::with('subpackage')->whereNUll('parent_id')->get();
        $settings = Setting::where('type','logo')->value('image');
        $settingContact = Setting::where('type','contact')->first();  
        $data['packageType'] = PackageType::whereNotNUll('parent_id')->get();
        return view('web.pages.privacypolicy',compact('data','packageTypes','settings','settingContact'));
    }

    public function SaveContactUs(Request $request){

        $this->validate($request,[
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required|email',
            'mobile_number' => 'required|numeric|max_digits:11',
            'message' => 'required'
        ]);
        
        try{
            ContactUs::create([
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
                'mobile_number' => $request->mobile_number,
                'email' => $request->email,
                'message' => $request->message,
        ]);

        return redirect()->back()->with('success','Contat data send successfully.MyVacayHost team contact you shortly!');
        }catch(Exception $e){
            Log::info('contact Us:'. $e->getMessage());
            return redirect()->back()->with('error','something missing');
        } 
    }
}
