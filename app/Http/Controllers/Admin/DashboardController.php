<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        $newBookings = Booking::pending()->count();
        $notifications = DB::table('notifications')->where('notifiable_id', auth('sanctum')->user()->id)->count();

        $data['stats'] = [
            'bookings' => $newBookings,
            'notifications' => $notifications
        ];

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
