<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        DB::beginTransaction();
        try {
            $booking = new Booking();
            $booking->c_formName = $request->c_formName;
            $booking->c_currency = $request->c_currency;
            $booking->departure_date = $request->departure_date;
            $booking->departure_city = $request->departure_city;
            $booking->passengers_adult = $request->passengers_adult;
            $booking->passengers_children = $request->passengers_children;
            $booking->passengers_infant = $request->passengers_infant;
            $booking->room_occupancy = $request->room_occupancy;
            $booking->passenger_name = $request->passenger_name;
            $booking->phone = $request->phone_code.$request->phone;
            $booking->c_email = $request->c_email;
            $booking->signup = $request->signup;
            $booking->package_id = $request->package_id;
            $booking->package_name = $request->package_name;
            $booking->transaction_id = Str::random(10);
            $booking->special_requests = $request->special_requests;
            $booking->status = 'Booking';
            $booking->save();

            DB::commit();


            Mail::send('email.booking', compact('booking'), function ($message) use ($booking) {
                $message->to($booking->c_email, $booking->passenger_name)->subject('Booking Inquiry:' . $booking->package_name);
                $message->from('employee@myvacayhost.com','My Vacay Host');
            });

            return response()->json([
                'success' => true,
                // 'modalContent' => view('web.packages.modal.requestbooking')->render(),
                'message' => 'Booking request submitted successfully.',
            ], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Booking request failed: ' . $exception->getMessage());


            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your booking request.',
            ], 500);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
