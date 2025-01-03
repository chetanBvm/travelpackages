<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmailTemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $template = EmailTemplate::get();
        return view('admin.emailtemplate.index',compact('template'));
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
        //
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
    public function edit(Request $request, string $id)
    {
        $template = EmailTemplate::findOrFail($id);
        return view('admin.emailtemplate.edit',compact('template'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $template = EmailTemplate::findorFail($id);

        $this->validate($request,[
            'subject' =>'required|string',
            'body' => 'required|string',
            'name' => 'required|string|unique:email_templates,name,' . $template->id
        ]);

        try{
            $template->updateOrCreate(['id' => $template->id],[
                'subject' => $request->subject,
                'body' => $request->body,
                'name' => $request->name,
            ]);

            return redirect()->route('email-template.index')->with('success','Email template created successfully');
        }catch(Exception $e){
            Log::info('EmailTemplate:'.$e->getMessage());
            return redirect()->back()->with('error','Something missing!');
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
