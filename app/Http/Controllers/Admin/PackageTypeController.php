<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageTypeStoreRequest;
use App\Http\Requests\PackageTypeUpdateRequest;
use App\Models\PackageType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PackageTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data= PackageType::with('parent')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('parent', function ($row) {
                    return $row->parent ? $row->parent->name : 'None';
                     
                })
                ->addColumn('action', function ($row) {
                    $urlpath = url('admin/package-type');
                    return '<a href="' . $urlpath . '/' . $row->id . '/edit' . '" class="edit"><i class="material-icons">edit</i></a><a href="javascript:void(0);" onClick="deleteFunc(' . $row->id . ')" class="delete"><i class="material-icons">delete</i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.package-type.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = PackageType::where('parent_id', null)->orderby('name', 'asc')->get();
        return view('admin.package-type.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageTypeStoreRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $asset_icon=null;
            //Check if the request has an image file
            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                $asset_icon = $file->storeAs('uploads/packages', $tempName, 'public');
            }
            PackageType::create([
                'name' => $validated['name'],
                'parent_id' =>$validated['parent_id'],
                'icon' => $asset_icon,
            ]);
            DB::commit();  //commit the transaction

            return redirect()->route('package-type.index')->with('success', 'Package type Created Successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error creating package type: ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while creating the package type');
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
        //Find the package type by its ID
        $packageType = PackageType::findOrFail($id);
        $packageSubType = PackageType::where('parent_id', null)->where('id', '!=', $packageType->id)->orderby('name', 'asc')->get();
        return view('admin.package-type.edit', compact('packageType','packageSubType'));        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageTypeUpdateRequest $request, string $id)
    {
        //find the package type by its ID
        $packageType = PackageType::findOrFail($id);
        DB::beginTransaction();
        try {
            // Validate the incoming request data
            $validated = $request->validated();

            // Update the package type record
            $packageType->update([
                'name' => $validated['name'],
                'parent_id' =>$validated['parent_id'],
            ]);

            //Check if the request has an image file
            if ($request->hasFile('icon')) {
                // Validate the image file (optional, add size/extension validation if necessary)
                $request->validate([
                    'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $file = $request->file('icon');
                $tempName = uniqid('asset_', true) . '.' . $file->getClientOriginalExtension();
                $oldFilePath = 'uploads/packages' . $packageType->icon;
                if (Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }
                $asset_icon = $file->storeAs('uploads/packages', $tempName, 'public');
                $packageType->update([
                    'icon' => $asset_icon,
                ]);
            }

            DB::commit(); //commit the transaction

            return redirect()->route('package-type.index')->with('success', 'Package type updated successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error updating package type: ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while updating the package type');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $packageType = PackageType::findOrFail($id);

        
        if(count($packageType->subpackage))
        {
            $subcategories = $packageType->subpackage;
            foreach($subcategories as $cat)
            {
                $cat = PackageType::findOrFail($cat->id);
                $cat->parent_id = null;
                $cat->save();
            }
        }
        $packageType->delete();

        return response()->json(['success' => 'Package type deleted successfully!']);
    }
}
