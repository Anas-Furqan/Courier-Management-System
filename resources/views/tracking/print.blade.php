<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Slip — {{ $shipment->tracking_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .no-print { display: none !important; }
        }
        body { font-family: 'Instrument Sans', system-ui, sans-serif; }
    </style>
</head>
<body class="bg-white text-black p-8">

    {{-- Print Button --}}
    <div class="no-print mb-6 flex gap-4">
        <button onclick="window.print()" class="neo-btn bg-black text-white">🖨️ Print Slip</button>
        <a href="javascript:history.back()" class="neo-btn bg-gray-200 text-black">← Back</a>
    </div>

    {{-- Slip --}}
    <div class="max-w-3xl mx-auto border-4 border-black p-10" style="box-shadow: 8px 8px 0 0 #000;">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8 pb-6 border-b-4 border-black">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-yellow-300 border-4 border-black flex items-center justify-center font-black text-xl" style="box-shadow:3px 3px 0 #000;">DI</div>
                <div>
                    <p class="font-black text-2xl">DeliverIt</p>
                    <p class="font-bold text-sm text-gray-600">Courier Management System</p>
                </div>
            </div>
            <div class="text-right">
                <p class="font-black text-xs uppercase tracking-widest text-gray-500 mb-1">Tracking Slip</p>
                <p class="font-black font-mono text-xl">{{ $shipment->tracking_number }}</p>
            </div>
        </div>

        {{-- Route Grid --}}
        <div class="grid grid-cols-2 gap-6 mb-8">
            <div class="border-4 border-black p-6 bg-yellow-300" style="box-shadow:4px 4px 0 #000;">
                <p class="text-xs font-black uppercase tracking-widest mb-2">From</p>
                <p class="text-3xl font-black">{{ $shipment->from_city }}</p>
            </div>
            <div class="border-4 border-black p-6 bg-cyan-400" style="box-shadow:4px 4px 0 #000;">
                <p class="text-xs font-black uppercase tracking-widest mb-2">To</p>
                <p class="text-3xl font-black">{{ $shipment->to_city }}</p>
            </div>
            <div class="border-4 border-black p-6 bg-green-400" style="box-shadow:4px 4px 0 #000;">
                <p class="text-xs font-black uppercase tracking-widest mb-2">Status</p>
                <p class="text-2xl font-black">{{ str_replace('_',' ',$shipment->status) }}</p>
            </div>
            <div class="border-4 border-black p-6 bg-pink-400" style="box-shadow:4px 4px 0 #000;">
                <p class="text-xs font-black uppercase tracking-widest mb-2">Courier Type</p>
                <p class="text-2xl font-black">{{ ucfirst($shipment->courier_type ?? 'Standard') }}</p>
            </div>
        </div>

        {{-- Details --}}
        <div class="grid grid-cols-3 gap-4 border-t-4 border-black pt-6">
            <div>
                <p class="text-xs font-black uppercase tracking-widest text-gray-500 mb-1">Weight</p>
                <p class="font-black text-lg">{{ $shipment->weight }} kg</p>
            </div>
            <div>
                <p class="text-xs font-black uppercase tracking-widest text-gray-500 mb-1">Booked</p>
                <p class="font-black text-lg">{{ $shipment->booking_date?->format('M d, Y') ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-xs font-black uppercase tracking-widest text-gray-500 mb-1">Est. Delivery</p>
                <p class="font-black text-lg">{{ $shipment->expected_delivery_date?->format('M d, Y') ?? 'N/A' }}</p>
            </div>
        </div>

        {{-- Footer --}}
        <div class="mt-8 pt-6 border-t-4 border-black text-center">
            <p class="font-bold text-sm text-gray-600">DeliverIt Courier Management System — Pakistan</p>
        </div>
    </div>

    <script>window.onload = function() { window.print(); }</script>
</body>
</html>
