<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    /*
    |-------------------------------------------------------------------
    | MUTATORS
    |-------------------------------------------------------------------
    */
    public function setPickupDateAttribute($value)
    {
        $this->attributes['pickup_date'] = Carbon::parse($value)->format("Y-m-d");
    }

    public function setDeliveryDateAttribute($value)
    {
        $this->attributes['delivery_date'] = Carbon::parse($value)->format("Y-m-d");
    }

    /*
    |-------------------------------------------------------------------
    | ACCESSORS
    |-------------------------------------------------------------------
    */
    public function getPickupDateAttribute($value)
    {
        return Carbon::parse($value)->toFormattedDateString();
    }

    public function getDeliveryDateAttribute($value)
    {
        return Carbon::parse($value)->toFormattedDateString();
    }

    /*
    |-------------------------------------------------------------------
    | SCOPES
    |-------------------------------------------------------------------
    */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeDelivered($query)
    {
        return $query->where('status', 'delivered');
    }
}

