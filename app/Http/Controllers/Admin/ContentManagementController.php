<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContentManagementController extends Controller
{
    public function homeBanner()
    {
        $info = ContentManagement::where('type', 'home_banner')->first();
        return view('admin.cms-pages.homebanner', compact('info'));
    }

    public function homeBannerSave(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
            'image.*' => 'nullable|image|mimes:png,jpg,jpeg|min:2',
        ]);
        
        try {
            $asset_images = [];
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();                           
                    $path = $file->storeAs('uploads/home', $tempName, 'public');
                    $asset_images[] = $path; 
                }
            } else {
                $existing_images = ContentManagement::where('type', 'home_banner')->value('image');
                $asset_images = $existing_images ? json_decode($existing_images, true) : [];
            }

            ContentManagement::updateOrCreate(
                ['type' => 'home_banner'],
                [
                    'title' => $request->title,
                    'subtitle' => $request->subtitle,
                    'image' => json_encode($asset_images),
                ]
            );

            return redirect()->back()->with('success', 'Home Banner Create successfully');
        } catch (\Exception $exception) {
            Log::error('Error creating Home Banner: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'something went wrong while creating Home Banner');
        }
    }

    public function homeDestination()
    {
        $info = ContentManagement::where('type', 'home_destination')->first();
        return view('admin.cms-pages.destination', compact('info'));
    }

    public function homeDestinationSave(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
        ]);
        try {
            ContentManagement::updateOrCreate(
                ['type' => 'home_destination'],
                [
                    'title' => $request->title,
                    'subtitle' => $request->subtitle,
                ]
            );
            return redirect()->back()->with('success', 'Home Destination Create successfully');
        } catch (\Exception $exception) {
            Log::error('Error creating Home Banner: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'something went wrong while creating Home Destination');
        }
    }

    public function homeStay()
    {
        $info = ContentManagement::where('type', 'home_stay')->first();
        return view('admin.cms-pages.stay', compact('info'));
    }

    public function homeStaySave(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        try {
            ContentManagement::updateOrCreate(
                ['type' => 'home_stay'],
                [
                    'title' => $request->title,
                ]
            );
            return redirect()->back()->with('success', 'Home Stay Create successfully');
        } catch (\Exception $exception) {
            Log::error('Error creating Home stay: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'something went wrong while creating Home stay');
        }
    }

    public function homeSection()
    {
        $info = ContentManagement::where('type', 'home_section')->first();
        return view('admin.cms-pages.homesection', compact('info'));
    }

    public function homeSectionSave(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
            'image' => 'nullable|mimes:mp4,avi,wmv,mov,webm,3gp|max:10240', //max 10 MB
        ],[
            'image.mimes' => 'The uploaded file must be a video of type: mp4, avi, wmv, mov, webm, or 3gp.',
            'image.max' => 'The video must not be larger than 10 MB.',
        ]);
        try {
            $asset_video = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();

                $asset_video = $file->storeAs('uploads/section', $tempName, 'public');
            } else {
                $asset_video = ContentManagement::where('type', 'home_section')->value('image');
            }

            ContentManagement::updateOrCreate(
                ['type' => 'home_section'],
                [
                    'title' => $request->title,
                    'subtitle' => $request->subtitle,
                    'image' => $asset_video,
                ]
            );
            return redirect()->back()->with('success', 'Home section Create successfully');
        } catch (\Exception $exception) {
            Log::error('Error creating Home Section: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'something went wrong while creating Home section');
        }
    }

    public function homeAirline()
    {
        $info = ContentManagement::where('type', 'home_airline')->first();
        return view('admin.cms-pages.homeairline', compact('info'));
    }

    public function homeAirlineSave(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        try {
            ContentManagement::updateOrCreate(
                ['type' => 'home_airline'],
                [
                    'title' => $request->title,
                ]
            );
            return redirect()->back()->with('success', 'Home Airline Create successfully');
        } catch (\Exception $exception) {
            Log::error('Error creating Home airline: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'something went wrong while creating Home airline');
        }
    }

    public function homePackage()
    {
        $info = ContentManagement::where('type', 'home_package')->first();
        return view('admin.cms-pages.homepackage', compact('info'));
    }

    public function homePackageSave(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        try {
            ContentManagement::updateOrCreate(
                ['type' => 'home_package'],
                [
                    'title' => $request->title,
                ]
            );
            return redirect()->back()->with('success', 'Home Package Create successfully');
        } catch (\Exception $exception) {
            Log::error('Error creating Home package: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'something went wrong while creating Home package');
        }
    }

    public function homeTravelExperience()
    {
        $info = ContentManagement::where('type', 'home_travelexperience')->first();
        return view('admin.cms-pages.homeexperience', compact('info'));
    }

    public function homeTravelExperienceSave(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
        ]);
        try {
            ContentManagement::updateOrCreate(
                ['type' => 'home_travelexperience'],
                [
                    'title' => $request->title,
                    'subtitle' => $request->subtitle,
                ]
            );
            return redirect()->back()->with('success', 'Home Travel Experience Create successfully');
        } catch (\Exception $exception) {
            Log::error('Error creating Home travel experinece: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'something went wrong while creating Home Travel Experience');
        }
    }

    public function homeTopBar()
    {
        $info = ContentManagement::where('type', 'home_topbar')->first();
        $info_social =   ContentManagement::where('type', 'home_topbar')->where('keywords','!=','main_title')->get();
        return view('admin.cms-pages.hometopbar', compact('info','info_social'));
    }

    public function homeTopBarSave(Request $request){
           
        $this->validate($request, [
            'title' => 'required',
            'social_link' => 'required|array',
            'social_link.*.name' => 'required|string',
            'social_link.*.url' => 'required|url'
        ]);
        try {
            ContentManagement::updateOrCreate(
                ['type' => 'home_topbar','keywords'=>'main_title'],
                ['title' => $request->title]
            );
            ContentManagement::where('type', 'home_topbar')
            ->where('keywords', '!=', 'main_title')
            ->delete();
            
            foreach($request->social_link as $link){
                ContentManagement::create([
                    'type' => 'home_topbar',
                    'keywords' => $link['name'], 
                    'title' => $link['name'], 
                    'social_link' => $link['url'], 
                ]);
            }
            return redirect()->back()->with('success', 'Home Top Bar  Create successfully');
        } catch (\Exception $exception) {
            Log::error('Error creating Home top bar: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'something went wrong while creating Home Top Bar');
        }
    }
    
    public function aboutBanner()
    {
        $info = ContentManagement::where('type', 'about_banner')->first();
        return view('admin.cms-pages.about.aboutbanner', compact('info'));
    }

    public function aboutBannerSave(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);
        try {
            $asset_image = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                if ($file->getClientOriginalExtension() === 'jpg' || $file->getClientOriginalExtension() === 'jpeg' || $file->getClientOriginalExtension() === 'png') {
                    $asset_image = $file->storeAs('uploads/about', $tempName, 'public');
                }
            } else {
                $asset_image = ContentManagement::where('type', 'about_banner')->value('image');
            }

            ContentManagement::updateOrCreate(
                ['type' => 'about_banner'],
                [
                    'title' => $request->title,
                    'subtitle' => $request->subtitle,
                    'image' => $asset_image,
                ]
            );

            return redirect()->back()->with('success', 'About Banner Create successfully');
        } catch (\Exception $exception) {
            Log::error('Error creating about Banner: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'something went wrong while creating About Banner');
        }
    }

    public function aboutWelcome()
    {
        $info = ContentManagement::where('type', 'about_welcome')->first();
        return view('admin.cms-pages.about.aboutwelcome', compact('info'));
    }

    public function aboutWelcomeSave(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
            'image_1' => 'image|mimes:png,jpg,jpeg',
            'image_2' => 'image|mimes:png,jpg,jpeg',
        ]);

        try {
            $asset_image = [];
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                $asset_image[] = $file->storeAs('uploads/about/welcome', $tempName, 'public');
            }
            if ($request->hasFile('image_1')) {
                $file = $request->file('image_2');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                $asset_image[] = $file->storeAs('uploads/about/welcome', $tempName, 'public');
            }
            if ($request->hasFile('image_2')) {
                $file = $request->file('image_2');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                $asset_image[] = $file->storeAs('uploads/about/welcome', $tempName, 'public');
            } else {
                $asset_image = ContentManagement::where('type', 'about_welcome')->value('image', 'image_1', 'image_2');
            }

            ContentManagement::updateOrCreate(
                ['type' => 'about_welcome'],
                [
                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => json_encode($asset_image),
                ]
            );

            return redirect()->back()->with('success', 'About welcome Create successfully');
        } catch (\Exception $exception) {
            Log::error('Error creating about welcome: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'something went wrong while creating About welcome');
        }
    }

    public function aboutTravelService()
    {
        $info = ContentManagement::where('type', 'about_travelservice')->first();
        return view('admin.cms-pages.about.abouttravelservice', compact('info'));
    }

    public function aboutTravelServiceSave(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'header_title' => 'required',
            'header_content' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);
        try {
            $asset_image = null;
            $asset_icon = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                if ($file->getClientOriginalExtension() === 'jpg' || $file->getClientOriginalExtension() === 'jpeg' || $file->getClientOriginalExtension() === 'png') {
                    $asset_image = $file->storeAs('uploads/about/service', $tempName, 'public');
                }
            } else {
                $asset_image = ContentManagement::where('type', 'about_travelservice')->value('image');
            }
            //save the icon image
            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                if ($file->getClientOriginalExtension() === 'jpg' || $file->getClientOriginalExtension() === 'jpeg' || $file->getClientOriginalExtension() === 'png') {
                    $asset_icon = $file->storeAs('uploads/about/service/icon', $tempName, 'public');
                }
            } else {
                $asset_icon = ContentManagement::where('type', 'about_travelservice')->value('icon');
            }


            ContentManagement::updateOrCreate(
                ['type' => 'about_travelservice'],
                [
                    'title' => $request->title,
                    'header_title' => $request->header_title,
                    'header_content' => $request->header_content,
                    'image' => $asset_image,
                    'icon' => $asset_icon,
                ]
            );

            return redirect()->back()->with('success', 'About travel service Create successfully');
        } catch (\Exception $exception) {
            Log::error('Error creating about travel service: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'something went wrong while creating About travel service');
        }
    }

    public function aboutTravelserviceContent()
    {
        $info = ContentManagement::where('type', 'about_travelservicecontent')->first();
        return view('admin.cms-pages.about.abouttravelservicecontent', compact('info'));
    }

    public function aboutTravelserviceContentSave(Request $request)
    {
        $this->validate($request, [
            'header_title' => 'required',
            'header_content' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);
        try {
            $asset_image = null;
            $asset_icon = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                if ($file->getClientOriginalExtension() === 'jpg' || $file->getClientOriginalExtension() === 'jpeg' || $file->getClientOriginalExtension() === 'png') {
                    $asset_image = $file->storeAs('uploads/about/service', $tempName, 'public');
                }
            } else {
                $asset_image = ContentManagement::where('type', 'about_travelservicecontent')->value('image');
            }
            //save the icon image
            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                if ($file->getClientOriginalExtension() === 'jpg' || $file->getClientOriginalExtension() === 'jpeg' || $file->getClientOriginalExtension() === 'png') {
                    $asset_icon = $file->storeAs('uploads/about/service/icon', $tempName, 'public');
                }
            } else {
                $asset_icon = ContentManagement::where('type', 'about_travelservicecontent')->value('icon');
            }


            ContentManagement::Create(
                [
                    'type' => 'about_travelservicecontent',
                    'header_title' => $request->header_title,
                    'header_content' => $request->header_content,
                    'image' => $asset_image,
                    'icon' => $asset_icon,
                ]
            );

            return redirect()->back()->with('success', 'About travel service content Create successfully');
        } catch (\Exception $exception) {
            Log::error('Error creating about travel service content: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'something went wrong while creating About travel service content');
        }
    }
    public function aboutTravelRecord()
    {
        $info = ContentManagement::where('type', 'about_travelrecord')->first();
        return view('admin.cms-pages.about.abouttrackrecord', compact('info'));
    }

    public function aboutTravelRecordSave(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);
        try {
            $asset_image = null;
            $asset_icon = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                if ($file->getClientOriginalExtension() === 'jpg' || $file->getClientOriginalExtension() === 'jpeg' || $file->getClientOriginalExtension() === 'png') {
                    $asset_image = $file->storeAs('uploads/about/record', $tempName, 'public');
                }
            } else {
                $asset_image = ContentManagement::where('type', 'about_travelrecord')->value('image');
            }
            //save the icon image
            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                if ($file->getClientOriginalExtension() === 'jpg' || $file->getClientOriginalExtension() === 'jpeg' || $file->getClientOriginalExtension() === 'png') {
                    $asset_icon = $file->storeAs('uploads/about/record/icon', $tempName, 'public');
                }
            } else {
                $asset_icon = ContentManagement::where('type', 'about_travelrecord')->value('icon');
            }


            ContentManagement::updateOrCreate(
                ['type' => 'about_travelrecord'],
                [
                    'title' => $request->title,
                    'subtitle' => $request->subtitle,
                    'image' => $asset_image,
                ]
            );

            return redirect()->back()->with('success', 'About travel record Create successfully');
        } catch (\Exception $exception) {
            Log::error('Error creating about travel record: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'something went wrong while creating About travel record');
        }
    }

    public function aboutTravelRecordWrapper()
    {
        return view('admin.cms-pages.about.abouttrackrecordwrapper');
    }

    public function aboutTravelRecordWrapperSave(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);
        try {
            $asset_icon = null;

            //save the icon image
            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                if ($file->getClientOriginalExtension() === 'jpg' || $file->getClientOriginalExtension() === 'jpeg' || $file->getClientOriginalExtension() === 'png') {
                    $asset_icon = $file->storeAs('uploads/about/record/icon', $tempName, 'public');
                }
            } else {
                $asset_icon = ContentManagement::where('type', 'about_travelrecordwrapper')->value('icon');
            }


            ContentManagement::create(
                [
                    'type' => 'about_travelrecordwrapper',
                    'title' => $request->title,
                    'subtitle' => $request->subtitle,
                    'icon' => $asset_icon,
                ]
            );

            return redirect()->back()->with('success', 'About travel record wrapper Create successfully');
        } catch (\Exception $exception) {
            Log::error('Error creating about travel record wrapper:  ' . $exception->getMessage());
            return redirect()->back()->with('error', 'something went wrong while creating About travel record wrapper');
        }
    }
}
