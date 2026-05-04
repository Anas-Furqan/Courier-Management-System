<?php

namespace App\Http\Controllers;

use App\Models\SMSLog;
use App\Models\Shipment;

class SMSController extends Controller
{
    public function sendFromToSMS(string $id)
    {
        $shipment = Shipment::with('sender', 'receiver')->findOrFail($id);
        $message = "Shipment {$shipment->tracking_number} booked from {$shipment->from_city} to {$shipment->to_city}.";

        SMSLog::create([
            'shipment_id' => $shipment->id,
            'recipient_phone' => $shipment->sender->phone ?? '',
            'message' => $message,
            'sms_type' => 'from_to',
            'sent_at' => now(),
        ]);

        return back()->with('success', 'Booking SMS logged successfully');
    }

    public function sendDeliverySMS(string $id)
    {
        $shipment = Shipment::with('sender', 'receiver')->findOrFail($id);
        $message = "Shipment {$shipment->tracking_number} has been delivered successfully.";

        SMSLog::create([
            'shipment_id' => $shipment->id,
            'recipient_phone' => $shipment->receiver->phone ?? '',
            'message' => $message,
            'sms_type' => 'delivery',
            'sent_at' => now(),
        ]);

        return back()->with('success', 'Delivery SMS logged successfully');
    }
}
