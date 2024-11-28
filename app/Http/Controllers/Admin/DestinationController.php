<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestinationStoreRequest;
use App\Models\Country;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Yajra\DataTables\DataTables;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Destination::with('country');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($row){
                    $url= asset('storage/').'/'.$row->image;
                    return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
                })
                ->addColumn('action', function($row){
                    $urlpath = url('admin/destination');
                    return '<a href="'.$urlpath.'/'.$row->id.'/edit'.'" class="edit"><i class="bi bi-pen-fill"></i></a><a href="javascript:void(0);" onClick="deleteFunc('.$row->id.')" class="delete"><i class="bi bi-trash-fill"></i></a>';

                })
                ->rawColumns(['image','action'])
                ->make(true);
        }

        return view('admin.destination.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $country = Country::all();
        return view('admin.destination.create',compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DestinationStoreRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();

            $asset_image = null;
            //Check if the request has an image file
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                $asset_image = $file->storeAs('uploads/destination', $tempName, 'public');
            }
            Destination::create([
                'countries_id' => $validated['countries_id'],
                'type' => $validated['type'],
                'image' => $asset_image,
                'status' => $validated['status'],
            ]);

            DB::commit(); //commit the transaction

            return redirect()->route('destination.index')->with('success', 'Destination Created Successfully');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error creating destination: ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while creating the destination');
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
     * @return string $id
     */
    public function edit(string $id)
    {
        $destination = Destination::findOrFail($id);
        $country = Country::all();
        return view('admin.destination.edit', compact('destination','country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return string $id
     */
    public function update(DestinationStoreRequest $request, string $id)
    {
        //find the package by its ID
        $destination = Destination::findOrFail($id);

        DB::beginTransaction();

        try {
            // Validate the incoming request data
            $validated = $request->validated();

            // Update the destination record
            $destination->update([
                'countries_id' => $validated['countries_id'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);

            //Check if the request has an image file
            if ($request->hasFile('image')) {

                // Validate the image file (optional, add size/extension validation if necessary)
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $file = $request->file('image');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                $oldFilePath = 'uploads/destination' . $destination->images;
                if (Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }

                $asset_image = $file->storeAs('uploads/destination', $tempName, 'public');
                $destination->update([
                    'image' => $asset_image,
                ]);
            }

            DB::commit(); //commit the transaction

            return redirect()->route('destination.index')->with('success', 'Destination updated successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error updating destination: ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while updating the destination');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return string $id
     */
    public function destroy(string $id)
    {
        Destination::find($id)->delete();

        return response()->json(['success' => 'Destination deleted successfully!']);
    }
}
