<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'address',
        'phone',
        'email',
        'city',
        'gst_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sentShipments()
    {
        return $this->hasMany(Shipment::class, 'sender_id');
    }

    public function receivedShipments()
    {
        return $this->hasMany(Shipment::class, 'receiver_id');
    }
}
