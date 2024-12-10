<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageTypeStoreRequest;
use App\Models\PackageType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class PackageTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PackageType::all();

            return DataTables::of($data)
                ->addIndexColumn()
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
        return view('admin.package-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageTypeStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
           
            PackageType::create([
                'name' => $validated['name'],
                'status' => $validated['status'],
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
        return view('admin.package-type.edit', compact('packageType'));        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageTypeStoreRequest $request, string $id)
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
                'status' => $validated['status'],
            ]);

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

        $packageType->delete();

        return response()->json(['success' => 'Package type deleted successfully!']);
    }
}
