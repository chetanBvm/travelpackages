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
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);
        try {
            $asset_image = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                if ($file->getClientOriginalExtension() === 'jpg' || $file->getClientOriginalExtension() === 'jpeg' || $file->getClientOriginalExtension() === 'png') {
                    $asset_image = $file->storeAs('uploads/home', $tempName, 'public');
                }
            } else {
                $asset_image = ContentManagement::where('type', 'home_banner')->value('image');
            }

            ContentManagement::updateOrCreate(
                ['type' => 'home_banner'],
                [
                    'title' => $request->title,
                    'subtitle' => $request->subtitle,
                    'image' => $asset_image,
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
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
            'image' => 'nullable|mimes:mp4,avi,wmv,mov,webm,3gp|max:5048', //Add a max size limit 50 MB.
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


}
