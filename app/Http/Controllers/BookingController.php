<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

use App\Models\User;
use App\Models\Booking;
use App\Models\Admin;
use App\Http\Requests\BookingStoreRequest;
use App\Notifications\BookingRequest;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', auth('sanctum')->user()->id)->get();

        return response()->json([
            'success' => true,
            'bookings' => $bookings
        ], 200);
    }

    public function store(BookingStoreRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if(isset($user) || !empty($user)) {
            $userId = $user->id;
        } else {
            $newUser = new User();

            $newUser->first_name = $request->first_name;
            $newUser->last_name = $request->last_name;
            $newUser->email = $request->email;
            $newUser->password = Hash::make('123456');

            $newUser->save();

            $userId = $newUser->id;
        }

        $booking = new Booking();

        $booking->user_id = $userId;
        $booking->first_name = $request->first_name;
        $booking->last_name = $request->last_name;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->company = $request->company;
        $booking->pickup_address = $request->pickup_address;
        $booking->delivery_address = $request->delivery_address;
        $booking->cargo_type = $request->cargo_type;
        $booking->cargo_weight = $request->cargo_weight;
        $booking->truck_type = $request->truck_type;
        $booking->truck_qty = $request->truck_qty;
        $booking->pickup_date = $request->pickup_date;
        $booking->delivery_date = $request->delivery_date;
        $booking->message = $request->message;
        $booking->status = 'pending';

        $booking->save();

        $bookingId = $booking->id;

        // notify admins
        $admins = Admin::all();
        if(count($admins) > 0) {
            Notification::send($admins, new BookingRequest($userId, $bookingId));
        }

        return response()->json([
            'success' => true,
            'message' => 'Booking request submitted successfully'
        ], 200);
    }
}
