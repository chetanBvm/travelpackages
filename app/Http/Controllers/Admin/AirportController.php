<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AirportStoreRequest;
use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class AirportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Airport::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlpath = url('admin/airport');
                    return '<a href="' . $urlpath . '/' . $row->id . '/edit' . '" class="edit"><i class="material-icons">edit</i></a><a href="javascript:void(0);" onClick="deleteFunc(' . $row->id . ')" class="delete"><i class="material-icons">delete</i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.airport.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.airport.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AirportStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            
            Airport::create([
                'name' => $validated['name'],
                'code' => $validated['code'],
                'city' => $validated['city'],
                'country_name' => $validated['country_name'],
            ]);

            DB::commit(); //commit the airport

            return redirect()->route('airport.index')->with('success', 'Airport Created Successfully');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error creating airport: ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while creating the airport');
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
        $airport = Airport::findOrFail($id);
        return view('admin.airport.edit',compact('airport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AirportStoreRequest $request, string $id)
    {
        //find the airport by its ID
        $airport = Airport::findOrFail($id);

        DB::beginTransaction();
        try {
            // Validate the incoming request data
            $validated = $request->validated();

            // Update the banner record
            $airport->update([
                'name' => $validated['name'],
                'code' => $validated['code'],
                'city' => $validated['city'],
                'country_name' => $validated['country_name'],
            ]);


            DB::commit(); //commit the transaction

            return redirect()->route('airport.index')->with('success', 'Airport updated successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error updating package: ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while updating the airport');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Airport::find($id)->delete();

        return response()->json(['success','Airport deleted successfully!']);
    }
}
