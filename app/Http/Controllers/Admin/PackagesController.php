<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageStoreRequest;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Package::with('destiantion');

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
                         <button class="view-btn btn btn-sm btn-dark mr-2" data-id="'.$row->id.'">view</button>
                        <button class="edit-btn btn btn-sm btn-dark mr-2" data-id="'.$row->id.'">Edit</button>
                        <button class="delete-btn btn btn-sm btn-danger" data-id="'.$row->id.'">Delete</button>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.packages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.packages.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageStoreRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();

            //Check if the request has an image file
            if ($request->hasFile('images')) {
                $file = $request->file('images');
                $tempName = uniqid('asset_', true).'.'.$file->getClientOriginalExtension();
                $asset_image = $file->storeAs('uploads/packages', $tempName, 'public');
            }

            Package::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'images' => $asset_image,
                'days' => $validated['days'],
                'status' => $validated['status'],
            ]);
            DB::commit();  //commit the transaction

            return redirect()->route('packages.index')->with('success', 'Package Created Successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error creating package: '.$exception->getMessage(), [
                'exception' => $exception,
            ]);

            return redirect()->back()->with('error', 'something went wrong while creating the package');
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
     *
     * @return int id
     */
    public function edit(string $id)
    {
        //Find the package by its ID
        // $package = Package::findOrFail($id);

        return view('admin.packages.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageStoreRequest $request, string $id)
    {
        //find the package by its ID
        $package = Package::findOrFail($id);
        DB::beginTransaction();
        try {
            // Validate the incoming request data
            $validated = $request->validated();

            // Update the package record
            $package->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'days' => $validated['days'],
                'status' => $validated['status'],
            ]);

            //Check if the request has an image file
            if ($request->hasFile('images')) {

                // Validate the image file (optional, add size/extension validation if necessary)
                $request->validate([
                    'images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $file = $request->file('images');
                $tempName = uniqid('asset_', true).'.'.$file->getClientOriginalExtension();
                $oldFilePath = 'uploads/packages'.$package->images;
                if (Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }

                $asset_image = $file->storeAs('uploads/packages', $tempName, 'public');
                $package->update([
                    'images' => $asset_image,
                ]);
            }

            DB::commit(); //commit the transaction

            return redirect()->route('packages.index')->with('success', 'Package updated successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error updating package: '.$exception->getMessage(), [
                'exception' => $exception,
            ]);

            return redirect()->back()->with('error', 'something went wrong while updating the package');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return string $id
     */
    public function destroy(string $id)
    {
        // Find the package by its ID
        $package = Package::findOrFail($id);

        DB::beginTransaction();
        try {
            if ($package->images && Storage::disk('public')->exists('uploads/packages/'.$package->images)) {
                Storage::disk('public')->delete('uploads/packages/'.$package->images); // Delete the image file
            }

            $package->delete();

            DB::commit();  //Commit the transaction

            // Redirect to the packages index with a success message
            return redirect()->route('packages.index')->with('success', 'Package deleted successfully!');
        } catch (\Exception $exception) {
            // Roll back the transaction if an error occurs
            DB::rollBack();

            // Log the error for debugging
            Log::error('Error deleting package: '.$exception->getMessage(), [
                'exception' => $exception,
            ]);

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Something went wrong while deleting the package.');
        }
    }
}
