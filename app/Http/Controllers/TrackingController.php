<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index()
    {
        return view('tracking.index');
    }

    public function show(string $trackingNumber)
    {
        $shipment = Shipment::with(['sender.user', 'receiver.user', 'tracking.updatedBy', 'smsLogs'])
            ->where('tracking_number', $trackingNumber)
            ->firstOrFail();

        return view('tracking.show', [
            'shipment' => $shipment,
            'trackingNumber' => $trackingNumber,
            'printMode' => false,
        ]);
    }

    public function print(string $trackingNumber)
    {
        $shipment = Shipment::with(['sender.user', 'receiver.user', 'tracking.updatedBy', 'smsLogs'])
            ->where('tracking_number', $trackingNumber)
            ->firstOrFail();

        return view('tracking.show', [
            'shipment' => $shipment,
            'trackingNumber' => $trackingNumber,
            'printMode' => true,
        ]);
    }
}
