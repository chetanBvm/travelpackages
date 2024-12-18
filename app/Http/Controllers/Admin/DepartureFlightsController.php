<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartureFlightStoreRequest;
use App\Http\Requests\DepartureFlightUpdateRequest;
use App\Models\DepartureFlights;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class DepartureFlightsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DepartureFlights::with('package');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlpath = url('admin/departure-flights');
                    return '<a href="' . $urlpath . '/' . $row->id . '/edit' . '" class="edit"><i class="material-icons">edit</i></a><a href="javascript:void(0);" onClick="deleteFunc(' . $row->id . ')" class="delete"><i class="material-icons">delete</i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.departure.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $package = Package::get();
        return view('admin.departure.create', compact('package'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartureFlightStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            foreach ($validated['departure_date'] as $index => $departureDate) {
                DepartureFlights::create([
                    'package_id' => $validated['package_id'],
                    'year' => $validated['year'],
                    'departure_date' => $departureDate,
                    'return_date' => $validated['return_date'][$index],
                    'price' => $validated['price'][$index], 
                    'status' => $validated['status'][$index],
                    'category' => $validated['category'][$index],
                ]);
            }
            DB::commit();  //commit the transaction

            return redirect()->route('departure-flights.index')->with('success', 'departure flight Created Successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error creating departure flight: ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while creating the Departure flight ');
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
        $departureFlight = DepartureFlights::findOrFail($id);
        $package = Package::get();
        return view('admin.departure.edit', compact('departureFlight', 'package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartureFlightUpdateRequest $request, string $id)
    {
        //find the package by its ID
        $departureFlight = DepartureFlights::findOrFail($id);
        DB::beginTransaction();
        try {
            // Validate the incoming request data
            $validated = $request->validated();
            $departureFlight->update([
                'package_id' => $validated['package_id'],
                'year' => $validated['year'],
                'departure_date' => $validated['departure_date'],
                'return_date' => $validated['return_date'],
                'price' => $validated['price'],
                'status' => $validated['status'],
                'category' => $validated['category']
                ]);
            DB::commit(); //commit the transaction

            return redirect()->route('departure-flights.index')->with('success', 'Departure Flights updated successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error updating Departure Flights: ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while updating the departure flights');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $departureFlight = DepartureFlights::findOrFail($id);

        $departureFlight->delete();

        return response()->json(['success' => 'departure flight deleted successfully!']);
    }
}
