<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Booking::with('airport')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $urlpath = url('admin/bookings');
                    return '<a href="'.$urlpath.'/'.$row->id.'/edit'.'" class="edit"><i class="bi bi-pen-fill"></i></a><a href="javascript:void(0);" onClick="deleteFunc('.$row->id.')" class="delete"><i class="bi bi-trash-fill"></i></a>';

                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.bookings.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bookings.create');
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
    public function edit(string $id)
    {
        $bookings = Booking::findOrFail($id);
        return view('admin.bookings.edit',compact('bookings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bookings = Booking::findOrFail($id);
        
        $package = Package::findOrfail($bookings->package_id);
                
        if($request->formData == 'Approved'){
            $bookings->status = 'approved';
            $bookings->save();
    
            // $paymentLink = route('payment.link', ['bookingId' => $bookings->id]);

            // $mailData = [
            //     'name' => $bookings->passenger_name,
            //     // 'link' => $paymentLink,
            // ];
    
            Mail::send('email.approve_booking', compact('bookings','package'), function ($message) use ($bookings) {
                $message->to($bookings->c_email)->subject('Booking Approved');
            });
            
            return response()->json(['success' => true]);
        }elseif ($request->formData == 'rejected') {
            $request->validate([
                'reason' => 'required|string|max:255',
            ]);
    
            // Update booking status to rejected and save the reason
            $bookings->status = 'rejected';
            $bookings->reject_reason = $request->reason;
            $bookings->save();
    
            Mail::send('email.reject_booking',compact('bookings'), function ($message) use ($bookings) {
                $message->to($bookings->c_email)->subject('Booking Rejected');
            });

            return response()->json(['success' => true, 'message' => 'Booking rejected with reason saved.']);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $booking = Booking::findOrFail($id);

        $reason = $request->input('reason');

        // $booking->delete();

        $booking->status = 'Cancel';
        $booking->cancellation_reason = $reason;
        $booking->update();

        //Sending the mail after the update the status cancel 
        Mail::send('email.cancel_booking',compact('booking','reason'), function ($message) use ($booking) {
            $message->to($booking->c_email)->subject('Booking Cancel');
        });

        return response()->json(['success','Booking Cancel successfully']);
    }
}
