<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $fillable = [
        'user_id',
        'branch_city',
        'agent_code',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shipments()
    {
        return Shipment::where('from_city', $this->branch_city)
                       ->orWhere('to_city', $this->branch_city);
    }
}
