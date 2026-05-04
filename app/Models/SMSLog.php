<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SMSLog extends Model
{
    protected $table = 'sms_logs';
    
    protected $fillable = [
        'shipment_id',
        'recipient_phone',
        'message',
        'sms_type',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
}
