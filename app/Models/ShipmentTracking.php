<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentTracking extends Model
{
    protected $table = 'shipment_tracking';
    
    protected $fillable = [
        'shipment_id',
        'status',
        'location',
        'notes',
        'updated_by',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
