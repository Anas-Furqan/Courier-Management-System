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

    public function search()
    {
        return view('tracking.index');
    }

    public function view(string $trackingNumber)
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

    public function myShipments()
    {
        $customer = auth()->user()->customer;
        
        if (!$customer) {
            return redirect('/')->with('error', 'No customer profile found');
        }

        $sentShipments = Shipment::where('sender_id', $customer->id)->with('receiver')->latest()->paginate(15);
        
        return view('customer.shipments', compact('sentShipments'));
    }
}

