<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PackageImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PackageImages::with('package');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('images', function ($row) {
                    $url = asset('storage/') . '/' . $row->images;
                    return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                })                
                ->addColumn('action', function ($row) {
                    $urlpath = url('admin/package-image');
                    return '<a href="' . $urlpath . '/' . $row->id . '/edit' . '" class="edit"><i class="material-icons">edit</i></a><a href="javascript:void(0);" onClick="deleteFunc(' . $row->id . ')" class="delete"><i class="material-icons">delete</i></a>';
                })
                ->rawColumns(['images', 'action'])
                ->make(true);
        }
        return view('admin.packageimage.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $package = Package::get();
        return view('admin.packageimage.create', compact('package'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required',
            'images' => 'required|array|min:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each image
        ]);

        try {
            // Initialize an empty array to store the file paths
            $imagePaths = [];

            // Loop through the uploaded images
            if ($request->hasFile('images')) {
                // Loop over each uploaded image
                foreach ($request->file('images') as $image) {
                    // Generate a unique file name
                    $imageName = uniqid('image_', true) . '.' . $image->getClientOriginalExtension();
                    // Store the image and get the file path
                    $imagePath = $image->storeAs('uploads/packages/images', $imageName, 'public');

                    // Create a new record for each image in the database
                    PackageImages::create([
                        'package_id' => $request->package_id, // Assuming you have a 'package_id' in the request
                        'images' => $imagePath, // Store the file path
                    ]);
                }
            }

            return redirect()->route('package-image.index')->with('success', 'Images uploaded successfully!');
        } catch (\Exception $exception) {
            Log::error('Error creating packageImage: ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while creating the packageImage');
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
        $packageImage = PackageImages::findOrFail($id);
        $package = Package::get();
        return view('admin.packageimage.edit', compact('package', 'packageImage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $packageImage = PackageImages::findOrFail($id);

        $request->validate([
            'package_id' => 'required',
        ]);

        try {
           
            if ($request->hasFile('images')) {

                // Validate the image file (optional, add size/extension validation if necessary)
                $request->validate([
                    'images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $file = $request->file('images');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                $oldFilePath = 'uploads/packages' . $packageImage->images;
                if (Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }

                $asset_image = $file->storeAs('uploads/packages', $tempName, 'public');
                $packageImage->update([
                    'images' => $asset_image,
                    'package_id' => $request->package_id,
                ]);
            }

            return redirect()->route('package-image.index')->with('success', 'Images uploaded successfully!');
        } catch (\Exception $exception) {
            Log::error('Error updating packageImage: ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while updating the packageImage');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $package = PackageImages::findOrFail($id);

        $package->delete();


        return response()->json(['success', 'Packages Images Deleted Successfully']);
    }
}
