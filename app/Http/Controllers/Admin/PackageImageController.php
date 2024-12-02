<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
                    $images = json_decode($row->images, true); // Decode JSON array into a PHP array

                    // Prepare the image HTML (make sure you have images to show)
                    $imageHtml = '';
                    if (is_array($images) && !empty($images)) {
                        $images = array_slice($images, 0, 5);

                        foreach ($images as $image) {
                            // Generate image URLs
                            $url = asset('storage/' . $image);
                            $imageHtml .= '<img src="' . $url . '" alt="image" border="0" width="40" class="img-rounded" style="margin-right: 5px;" />';
                        }
                    }
                    return $imageHtml;                    
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
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each image
        ]);

        try {
            // Initialize an empty array to store the file paths
            $imagePaths = [];

            // Loop through the uploaded images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    // Generate a unique file name
                    $imageName = uniqid('image_', true) . '.' . $image->getClientOriginalExtension();
                    // Store the image and get the file path
                    $imagePath = $image->storeAs('uploads/packages/images', $imageName, 'public');
                    // Add the image path to the array
                    $imagePaths[] = $imagePath;
                }
            }
            PackageImages::Create([
                'package_id' => $request->package_id,
                'images' => json_encode($imagePaths) // Store the image paths as JSON    
            ]);

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
        return view('admin.packageimage.edit',compact('package','packageImage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $packageImage = PackageImages::findOrFail($id);

        $request->validate([
            'package_id' => 'required',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each image
        ]);

        try {
            // Initialize an empty array to store the file paths
            $existingImages = json_decode($packageImage->images, true) ?: [];


            // Loop through the uploaded images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    // Generate a unique file name
                    $imageName = uniqid('image_', true) . '.' . $image->getClientOriginalExtension();
                    // Store the image and get the file path
                    $imagePath = $image->storeAs('uploads/packages/images', $imageName, 'public');
                    // Add the image path to the array
                    $existingImages[] = $imagePath;
                }
            }
            $packageImage->update([
                'package_id' => $request->package_id,
                'images' => json_encode($existingImages)     
            ]);

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
        

        return response()->json(['success','Packages Images Deleted Successfully']);
    }
}
