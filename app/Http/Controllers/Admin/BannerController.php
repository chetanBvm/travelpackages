<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerStoreRequest;
use App\Models\Banner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Banner::query();

            return DataTables::of($data)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && $request->search != '') {
                        $query->where(function ($q) use ($request) {
                            $q->where('name', 'like', "%{$request->search}%");
                        });
                    }
                })
                ->addColumn('actions', function ($row) {
                    return '
                        <div class="d-flex">
                         <button class="view-btn btn btn-sm btn-dark mr-2" data-id="' . $row->id . '">view</button>
                        <button class="edit-btn btn btn-sm btn-dark mr-2" data-id="' . $row->id . '">Edit</button>
                        <button class="delete-btn btn btn-sm btn-danger" data-id="' . $row->id . '">Delete</button>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.banner.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerStoreRequest $request):RedirectResponse
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();

            //Check if the request has an image file
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $tempName = uniqid('asset_', true).'.'.$file->getClientOriginalExtension();
                $asset_image = $file->storeAs('uploads/banner', $tempName, 'public');
            }

            Banner::create([
                'name' => $validated['name'],
                'image' => $asset_image,
                'status' => $validated['status'],
            ]);

            DB::commit(); //commit the banner

            return redirect()->route('banner.index')->with('success', 'Banner Created Successfully');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error creating banner: ' . $exception->getMessage(), [
                'exception' => $exception,
            ]);

            return redirect()->back()->with('error', 'something went wrong while creating the banner');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerStoreRequest $request, string $id)
    {
        //find the banner by its ID
        $banner = Banner::findOrFail($id);
        
        DB::beginTransaction();
        try {
            // Validate the incoming request data
            $validated = $request->validated();

            // Update the banner record
            $banner->update([
                'name' => $validated['name'],
                'status' => $validated['status'],
            ]);

            //Check if the request has an image file
            if ($request->hasFile('image')) {

                // Validate the image file (optional, add size/extension validation if necessary)
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $file = $request->file('image');
                $tempName = uniqid('asset_', true).'.'.$file->getClientOriginalExtension();
                // $oldFilePath = 'uploads/packages'.$package->images;
                // if (Storage::disk('public')->exists($oldFilePath)) {
                //     Storage::disk('public')->delete($oldFilePath);
                // }

                $asset_image = $file->storeAs('uploads/banner', $tempName, 'public');
                $banner->update([
                    'image' => $asset_image,
                ]);
            }

            DB::commit(); //commit the transaction

            return redirect()->route('banner.index')->with('success', 'Banner updated successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error updating package: '.$exception->getMessage(), [
                'exception' => $exception,
            ]);

            return redirect()->back()->with('error', 'something went wrong while updating the banner');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Banner::find($id)->delete();

        return redirect()->route('banner.index')->with('success', 'Banner deleted successfully');
    }
}
