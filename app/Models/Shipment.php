<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'tracking_number',
        'sender_id',
        'receiver_id',
        'from_city',
        'to_city',
        'courier_type',
        'weight',
        'price',
        'status',
        'booking_date',
        'expected_delivery_date',
        'actual_delivery_date',
        'created_by',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'expected_delivery_date' => 'date',
        'actual_delivery_date' => 'date',
    ];

    public function sender()
    {
        return $this->belongsTo(Customer::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Customer::class, 'receiver_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tracking()
    {
        return $this->hasMany(ShipmentTracking::class, 'shipment_id')->orderBy('created_at', 'desc');
    }

    public function smsLogs()
    {
        return $this->hasMany(SMSLog::class);
    }

    public function getLatestStatus()
    {
        return $this->tracking()->first();
    }
}
