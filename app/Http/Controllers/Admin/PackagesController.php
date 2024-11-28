<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageStoreRequest;
use App\Models\Destination;
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
            $data = Package::with('destination.country');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlpath = url('admin/package');
                    return '<a href="' . $urlpath . '/' . $row->id . '/edit' . '" class="edit"><i class="material-icons">edit</i></a><a href="javascript:void(0);" onClick="deleteFunc(' . $row->id . ')" class="delete"><i class="material-icons">delete</i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.packages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if there are any destinations
        $destinationCount = Destination::count();

        // If no destinations exist, redirect to the destinations page with a message
        if ($destinationCount == 0) {
            return redirect()->route('destination.index')->with('error', 'Please create a destination before creating a package.');
        }

        // Get destinations if they exist
        $destination = Destination::with('country')->get();
        // Return the view with destinations
        return view('admin.packages.create', compact('destination'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageStoreRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $asset_image = null;
            //Check if the request has an image file
            if ($request->hasFile('images')) {
                $file = $request->file('images');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                $asset_image = $file->storeAs('uploads/packages', $tempName, 'public');
            }
            Package::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'images' => $asset_image,
                'days' => $validated['days'],
                'status' => $validated['status'],
                'destination_id' => $validated['destination_id'],
            ]);
            DB::commit();  //commit the transaction

            return redirect()->route('package.index')->with('success', 'Package Created Successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error creating package: ' . $exception->getMessage());

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
        $package = Package::findOrFail($id);
        $destination = Destination::with('country')->get();
        return view('admin.packages.edit', compact('package', 'destination'));
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
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                $oldFilePath = 'uploads/packages' . $package->images;
                if (Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }

                $asset_image = $file->storeAs('uploads/packages', $tempName, 'public');
                $package->update([
                    'images' => $asset_image,
                ]);
            }

            DB::commit(); //commit the transaction

            return redirect()->route('package.index')->with('success', 'Package updated successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error updating package: ' . $exception->getMessage(), [
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

        $package->delete();

        return response()->json(['success' => 'Package deleted successfully!']);
    }
}
