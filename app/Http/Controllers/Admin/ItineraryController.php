<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItineraryStoreRequests;
use App\Models\Itinerary;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class ItineraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Itinerary::with('package');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlpath = url('admin/itinerary');
                    return '<a href="' . $urlpath . '/' . $row->id . '/edit' . '" class="edit"><i class="material-icons">edit</i></a><a href="javascript:void(0);" onClick="deleteFunc(' . $row->id . ')" class="delete"><i class="material-icons">delete</i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.itinerary.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if there are any package
        $packageCount = Package::count();

        // If no package exist, redirect to the package page with a message
        if ($packageCount == 0) {
            return redirect()->route('package.index')->with('error', 'Please create a package before creating a itinerary.');
        }

        // Get package if they exist
        $package = Package::get();
        // Return the view with itinerary
        return view('admin.itinerary.create', compact('package'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItineraryStoreRequests $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();

            Itinerary::create([
                'package_id' => $validated['package_id'],
                'name' => $validated['name'],
                'description' => $validated['description'],
                'status' => $validated['status'],
            ]);
            DB::commit();  //commit the transaction

            return redirect()->route('itinerary.index')->with('success', 'Itinerary Created Successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error creating itinerary: ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while creating the itinerary');
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
        $itinerary = Itinerary::findOrFail($id);
        $package = Package::get();
        return view('admin.itinerary.edit', compact('itinerary', 'package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItineraryStoreRequests $request, string $id)
    {
        //find the itinerary by its ID
        $itinerary = Itinerary::findOrFail($id);
        DB::beginTransaction();
        try {
            // Validate the incoming request data
            $validated = $request->validated();

            // Update the package record
            $itinerary->update([
                'package_id' => $validated['package_id'],
                'name' => $validated['name'],
                'description' => $validated['description'],
                'status' => $validated['status'],
            ]);

            DB::commit(); //commit the transaction

            return redirect()->route('itinerary.index')->with('success', 'Itinerary updated successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error updating itinerary: ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while updating the itinerary');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Itinerary::find($id)->delete();

        return response()->json(['success' => 'Itinerary deleted successfully!']);
    }
}
