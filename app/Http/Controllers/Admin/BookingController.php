<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Models\Booking;
use App\Mail\BookingStatusEmail;

class BookingController extends Controller
{
    public function index()
    {
        $data = [];
        $newBookings = Booking::pending()->count();
        $notifications = DB::table('notifications')->where('notifiable_id', auth('sanctum')->user()->id)->count();
        $bookings = Booking::orderBy('created_at', 'desc')->get();

        $data['stats'] = [
            'bookings' => $newBookings,
            'notifications' => $notifications
        ];
        $data['bookings'] = $bookings;

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function show($bookingId)
    {
        $data = [];
        $newBookings = Booking::pending()->count();
        $notifications = DB::table('notifications')->where('notifiable_id', auth('sanctum')->user()->id)->count();
        $booking = Booking::find($bookingId);

        $data['stats'] = [
            'bookings' => $newBookings,
            'notifications' => $notifications
        ];
        $data['booking'] = $booking;

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function update(Request $request, $bookingId)
    {
        $booking = Booking::find($bookingId);
        if(!isset($booking) || empty($booking)) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found'
            ], 404);   
        }

        $booking->status = $request->status;
        $booking->update();

        try {   
         //   Mail::to($booking->email)->send(new BookingStatusEmail($booking));
        } catch(\Exception $e) {
            // echo $e->getMessage();
        }

        return response()->json([
            'success' => true,
            'message' => 'Well-don! Booking status updated successfully',
            'status' => $request->status
        ], 200);
    }
}
