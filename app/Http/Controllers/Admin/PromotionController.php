<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionStoreRequest;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Promotion::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlpath = url('admin/promotion');
                    return '<a href="' . $urlpath . '/' . $row->id . '/edit' . '" class="edit"><i class="material-icons">edit</i></a><a href="javascript:void(0);" onClick="deleteFunc(' . $row->id . ')" class="delete"><i class="material-icons">delete</i></a>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.promotion.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.promotion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PromotionStoreRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();

            Promotion::create([
                'name' => $validated['name'],
                'price' => $validated['price'],
                'type' => $validated['type'],
                'expiry_date' => $validated['expiry_date'],
                'status' => $validated['status'],
            ]);

            DB::commit(); //commit the promotion

            return redirect()->route('promotion.index')->with('success', 'Promotion Created Successfully');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error creating promotion: ' . $exception->getMessage(), [
                'exception' => $exception,
            ]);

            return redirect()->back()->with('error', 'something went wrong while creating the promotion');
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
        $promotion = Promotion::findOrFail($id);

        return view('admin.promotion.edit', compact('promotion'));
    }

    /**
     * Update the specified resource in storage.
     * 
     *  @return string $id
     */
    public function update(Request $request, string $id)
    {
        //find the package by its ID
        $promotion = Promotion::findOrFail($id);

        DB::beginTransaction();

        try {
            // Validate the incoming request data
            $validated = $request->validated();

            // Update the promotion record
            $promotion->update([
                'name' => $validated['name'],
                'type' => $validated['type'],
                'price' => $validated['price'],
                'expiry_date' => $validated['expiry_date'],
                'status' => $validated['status'],
            ]);

            DB::commit(); //commit the transaction

            return redirect()->route('promotion.index')->with('success', 'Promotion updated successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); //Roll back the data if something goes wrong

            // Log the entire exception for better debugging (with stack trace)
            Log::error('Error updating promotion: ' . $exception->getMessage(), [
                'exception' => $exception,
            ]);

            return redirect()->back()->with('error', 'something went wrong while updating the promotion');
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @return string $id
     */
    public function destroy(string $id)
    {
        Promotion::find($id)->delete();

        return redirect()->route('promotion.index')->with('success', 'Promotion deleted successfully');
    }
}
