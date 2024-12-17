<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartureCityStoreRequest;
use App\Models\DepartureCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class DepartureCityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DepartureCity::get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlpath = url('admin/departure-city');
                    return '<a href="' . $urlpath . '/' . $row->id . '/edit' . '" class="edit"><i class="material-icons">edit</i></a><a href="javascript:void(0);" onClick="deleteFunc(' . $row->id . ')" class="delete"><i class="material-icons">delete</i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.departure.city.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.departure.city.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartureCityStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
                DepartureCity::create([
                    'name' => $validated['name'],
                    'price' => $validated['price'], 
                ]);
            
            DB::commit();  //commit the transaction

            return redirect()->route('departure-city.index')->with('success', 'departure city Created Successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error creating departure city: ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while creating the Departure city');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departureCity = DepartureCity::findOrFail($id);
        return view('admin.departure.city.edit',compact('departureCity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartureCityStoreRequest $request, string $id)
    {
     //find the package by its ID
     $departureCity = DepartureCity::findOrFail($id);
     DB::beginTransaction();
     try {
         // Validate the incoming request data
         $validated = $request->validated();
         $departureCity->update([
    
             'name' => $validated['name'],
             'price' => $validated['price'],
             ]);
         DB::commit(); //commit the transaction

         return redirect()->route('departure-city.index')->with('success', 'Departure City updated successfully!');
     } catch (\Exception $exception) {
         DB::rollBack(); //Roll back the data if something goes wrong

         // Log the entire exception for better debugging (with stack trace)
         Log::error('Error updating Departure city: ' . $exception->getMessage());

         return redirect()->back()->with('error', 'something went wrong while updating the departure city');
     }   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $departureCity = DepartureCity::findOrFail($id);

        $departureCity->delete();

        return response()->json(['success' => 'departure city deleted successfully!']);
    }
}
