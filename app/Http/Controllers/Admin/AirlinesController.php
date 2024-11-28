<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AirlineStoreRequest;
use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class AirlinesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Airline::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($row){
                    $url= asset('storage/').'/'.$row->image;
                    return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
                })
                ->addColumn('action', function ($row) {
                    $urlpath = url('admin/airline');
                    return '<a href="' . $urlpath . '/' . $row->id . '/edit' . '" class="edit"><i class="material-icons">edit</i></a><a href="javascript:void(0);" onClick="deleteFunc(' . $row->id . ')" class="delete"><i class="material-icons">delete</i></a>';
                })
                ->rawColumns(['image','action'])
                ->make(true);
        }
        return view('admin.airline.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.airline.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AirlineStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $asset_image = null;
            //Check if the request has an image file
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                $asset_image = $file->storeAs('uploads/airline', $tempName, 'public');
            }

            Airline::create([
                'name' => $validated['name'],
                'image' => $asset_image,
                'status' => $validated['status'],
            ]);

            DB::commit(); //commit the stay

            return redirect()->route('airline.index')->with('success', 'Airline Created Successfully');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error creating stay: ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while creating the airline');
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
        $airline = Airline::findOrFail($id);
        return view('admin.airline.edit', compact('airline'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AirlineStoreRequest $request, string $id)
    {
         //find the airline by its ID
         $airline = Airline::findOrFail($id);

         DB::beginTransaction();
         try {
             // Validate the incoming request data
             $validated = $request->validated();
 
             // Update the stay record
             $airline->update([
                 'name' => $validated['name'],
                 'status' => $validated['status'],
             ]);
 
             //Check if the request has an image file
             if ($request->hasFile('image')) {
 
                 // Validate the image file (optional, add size/extension validation if necessary)
                 $request->validate([
                     'image' => $request->isMethod('post') || $request->hasFile('image') ? 'required|image|mimes:jpeg,png,gif,jpg' : 'nullable|image|mimes:jpeg,png,gif,jpg',
                     // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                 ]);
 
                 $file = $request->file('image');
                 $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                 // $oldFilePath = 'uploads/packages'.$package->images;
                 // if (Storage::disk('public')->exists($oldFilePath)) {
                 //     Storage::disk('public')->delete($oldFilePath);
                 // }
 
                 $asset_image = $file->storeAs('uploads/airline', $tempName, 'public');
                 $airline->update([
                     'image' => $asset_image,
                 ]);
             }
 
             DB::commit(); //commit the transaction
 
             return redirect()->route('airline.index')->with('success', 'Airline updated successfully!');
         } catch (\Exception $exception) {
             DB::rollBack(); //Roll back the data if something goes wrong
 
             // Log the entire exception for better debugging (with stack trace)
             Log::error('Error updating airline: ' . $exception->getMessage());
 
             return redirect()->back()->with('error', 'something went wrong while updating the airline');
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Airline::find($id)->delete();

        return response()->json(['success','Airline deleted successfully!']);
    }
}
