<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'company',
        'pickup_address',
        'delivery_address',
        'cargo_type',
        'cargo_weight',
        'truck_type',
        'truck_qty',
        'pickup_date',
        'delivery_date',
        'message',
        'status'
    ];
}

