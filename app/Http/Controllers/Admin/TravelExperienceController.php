<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TravelExperienceStoreRequest;
use App\Models\TravelExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class TravelExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TravelExperience::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $url = asset('storage/') . '/' . $row->image;
                    return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                })
                ->addColumn('action', function ($row) {
                    $urlpath = url('admin/travel-experience');
                    return '<a href="' . $urlpath . '/' . $row->id . '/edit' . '" class="edit"><i class="material-icons">edit</i></a><a href="javascript:void(0);" onClick="deleteFunc(' . $row->id . ')" class="delete"><i class="material-icons">delete</i></a>';
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        return view('admin.travel-experience.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.travel-experience.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TravelExperienceStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $asset_image = null;
            //Check if the request has an image file
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                $asset_image = $file->storeAs('uploads/travel-experience', $tempName, 'public');
            }

            TravelExperience::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'image' => $asset_image,

            ]);

            DB::commit(); //commit the travel experience

            return redirect()->route('travel-experience.index')->with('success', 'Travel Experience Created Successfully');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error creating Travel Experience: ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while creating the travel experience');
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
        $travel = TravelExperience::findOrFail($id);
        return view('admin.travel-experience.edit', compact('travel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TravelExperienceStoreRequest $request, string $id)
    {
        //find the travel by its ID
        $travel = TravelExperience::findOrFail($id);

        DB::beginTransaction();
        try {
            // Validate the incoming request data
            $validated = $request->validated();

            // Update the travel record
            $travel->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
            ]);

            //Check if the request has an image file
            if ($request->hasFile('image')) {

                // Validate the image file (optional, add size/extension validation if necessary)
                $request->validate([
                    'image' => $request->isMethod('post') || $request->hasFile('image') ? 'required|image|mimes:jpeg,png,gif,jpg' : 'nullable|image|mimes:jpeg,png,gif,jpg',
                ]);

                $file = $request->file('image');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                // $oldFilePath = 'uploads/packages'.$package->images;
                // if (Storage::disk('public')->exists($oldFilePath)) {
                //     Storage::disk('public')->delete($oldFilePath);
                // }

                $asset_image = $file->storeAs('uploads/travel-experience', $tempName, 'public');
                $travel->update([
                    'image' => $asset_image,
                ]);
            }

            DB::commit(); //commit the travel experience

            return redirect()->route('travel-experience.index')->with('success', 'Travel Experience updated successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error updating Travel Experience: ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while updating the Travel Experience');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TravelExperience::find($id)->delete();

        return response()->json(['success', 'Travel Experience deleted successfully!']);
    }
}
