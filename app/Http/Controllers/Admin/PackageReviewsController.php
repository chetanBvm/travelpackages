<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageReviewRequest;
use App\Http\Requests\PackageReviewStoreRequest;
use App\Models\Package;
use App\Models\PackageReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PackageReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PackageReview::with('package');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($row){
                    $url= asset('storage/').'/'.$row->images;
                    return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
                })
                ->addColumn('action', function ($row) {
                    $urlpath = url('admin/package-review');
                    return '<a href="' . $urlpath . '/' . $row->id . '/edit' . '" class="edit"><i class="material-icons">edit</i></a><a href="javascript:void(0);" onClick="deleteFunc(' . $row->id . ')" class="delete"><i class="material-icons">delete</i></a>';
                })
                ->rawColumns(['image','action'])
                ->make(true);
        }
        return view('admin.package-reviews.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $package = Package::get();
        return view('admin.package-reviews.create',compact('package'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageReviewStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $asset_image = null;
            //Check if the request has an image file
            if ($request->hasFile('images')) {
                $file = $request->file('images');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                $asset_image = $file->storeAs('uploads/package/review', $tempName, 'public');
            }

            
            PackageReview::create([
                'package_id' => $validated['package_id'],
                'name' => $validated['name'],
                'description' => $validated['description'],
                'images' => $asset_image,
                'status' => $validated['status'],
                
            ]);
            DB::commit();  //commit the transaction

            return redirect()->route('package-review.index')->with('success', 'Package Review Created Successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error creating package: ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while creating the package review');
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
        $packageReview = PackageReview::findOrFail($id);
        $package = Package::get();
        return view('admin.package-reviews.edit',compact('packageReview','package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageReviewStoreRequest $request, string $id)
    {
        //find the package by its ID
        $packageReview = PackageReview::findOrFail($id);
        DB::beginTransaction();
        try {
            // Validate the incoming request data
            $validated = $request->validated();

            // Update the package review record
            $packageReview->update([
                'package_id' => $validated['package_id'],
                'name' => $validated['name'],
                'description' => $validated['description'],
                'status' => $validated['status'],
            ]);

            //Check if the request has an image file
            if ($request->hasFile('images')) {

                // Validate the image file (optional, add size/extension validation if necessary)
                $request->validate([
                    'images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $file = $request->file('images');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                $oldFilePath = 'uploads/package/review' . $packageReview->images;
                if (Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }

                $asset_image = $file->storeAs('uploads/package/review', $tempName, 'public');
                $packageReview->update([
                    'images' => $asset_image,
                ]);
            }

            DB::commit(); //commit the transaction

            return redirect()->route('package-review.index')->with('success', 'Package Review updated successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error updating package review: ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while updating the package review');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pacakgeReview = PackageReview::findOrFail($id);

        $pacakgeReview->delete();
        return response()->json(['success','Pacakge Review deleted Successfully!']);
    }
}
