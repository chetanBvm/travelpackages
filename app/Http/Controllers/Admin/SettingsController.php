<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentManagement;
use App\Models\SeoManagement;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SettingsController extends Controller
{
    public function logo(){
        $logo = Setting::where('type','logo')->first();
        return view('admin.settings.logo',compact('logo'));
    }

    public function saveLogo(Request $request){
        
        
            $this->validate($request,[
                'image' => 'array',
                'image.*.*' => 'image|mimes:svg,png,jpg,jpeg'
            ]);
          
            try{
               $images = null;
                //save the logo 
                
                if ($request->file('image')) {
                    foreach ($request->file('image') as $key => $fileArray) {
                        foreach ($fileArray as $area => $file) {
                            $tempName = uniqid("asset_{$area}_", true) . '.' . $file->getClientOriginalExtension();
                            $images[$area] = $file->storeAs('uploads/settings/logo', $tempName, 'public');
                        }
                    }
                } else {
                    $images = SeoManagement::where('type', 'logo')->value('image');
                    $images = $images ? json_decode($images, true) : [];
                }

                Setting::updateOrCreate(['type' => 'logo'],[
                'image' =>  json_encode($images)
            ]);

            return redirect()->back()->with('success','Logo created successfully');
        }catch(Exception $e){
            Log::info(['Logo:'.$e->getMessage()]);
            return redirect()->back()->with(['error','something wrong!']);
        }
    }

    public function  contact(){
        $contact = Setting::where('type','contact')->first();
        return view('admin.settings.contact',compact('contact'));
    }

    public function SaveContact(Request $request){
        $this->validate($request,[
            'address' => 'required',
            'email' => 'required|email:rfc,dns',
            'mobile_number' => 'required',
            'toll_number' => 'required',
        ]);

        try{
            Setting::updateOrCreate(['type' => 'contact'],[
                'address' => $request->address,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'toll_number' =>$request->toll_number,
            ]);

            return redirect()->back()->with('success','Contact details updated successfully');
        }catch(Exception $e){
            Log::info('contact:'.$e->getMessage());
            return redirect()->back()->with('error','Something wrong Please check again');
        }
    }
    
    public function contactUs(){
        $contactus = ContentManagement::where('type','contactus')->first();
        return view('admin.settings.contactus',compact('contactus'));
    }

    public function saveContactUs(Request $request){
        
        $this->validate($request,[
            'title' => 'required|string',
            'subtitle' => 'required',
            'image' => 'array',
            'images.*'=> 'image|mimes:png,jpg,svg,jpeg',
        ]);

        try{
            $asset_images = [];
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();                           
                    $path = $file->storeAs('uploads/contactus', $tempName, 'public');
                    $asset_images[] = $path; 
                }
            } else {
                $existing_images = ContentManagement::where('type', 'contactus')->value('image');
                $asset_images = $existing_images ? json_decode($existing_images, true) : [];
            }

            ContentManagement::updateOrCreate(['type' => 'contactus'],[
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'image' => json_encode($asset_images)
            ]);
    
            return redirect()->back()->with('success','contactus created successfully!');
        }catch(Exception $e){
            Log::info('contactus:'. $e->getMessage());
            return redirect()->back()->with('error','Something missing');
        }
    } 
}
