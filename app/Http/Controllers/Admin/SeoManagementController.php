<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeomanagementStoreRequest;
use App\Models\SeoManagement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class SeoManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seo = SeoManagement::get();
        return view('admin.seo.index',compact('seo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
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
    public function edit(string $id,Request $request)
    {
        $ids = Crypt::decrypt($id);
        $seo = SeoManagement::findOrFail($ids);
        return view('admin.seo.edit',compact('seo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SeomanagementStoreRequest $request, string $id)
    {
        $seo = SeoManagement::findOrfail($id);
        try {
            $validated = $request->validated();

            $seo->updateOrCreate(['page_id' => $seo->page_id],[
                'meta_keywords' => $validated['meta_keywords'],
                'meta_description' =>  $validated['meta_description'],
                'title' => $validated['title'],
            ]);
                        
            return redirect()->route('seo-management.index')->with('message', 'seo management update Successfully!');
        } catch (Exception $exception) {
            Log::error('Error seo management : ' . $exception->getMessage());

            return redirect()->back()->with('error', 'something went wrong while creating seo management');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
