<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print - {{ $shipment->tracking_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white text-black p-8">
    <div class="max-w-4xl mx-auto">
        <div class="border-4 border-black p-12" style="box-shadow: 8px 8px 0 #000;">
            <h1 class="text-5xl font-black mb-2">TRACKING SLIP</h1>
            <p class="text-2xl font-bold font-mono">{{ $shipment->tracking_number }}</p>
            <div class="mt-8 grid gap-6 md:grid-cols-2">
                <div class="border-4 border-black p-6" style="background-color: #FCD34D; box-shadow: 4px 4px 0 #000;">
                    <p class="text-sm font-bold uppercase">From</p>
                    <p class="text-3xl font-black mt-2">{{ $shipment->from_city }}</p>
                </div>
                <div class="border-4 border-black p-6" style="background-color: #06B6D4; box-shadow: 4px 4px 0 #000;">
                    <p class="text-sm font-bold uppercase">To</p>
                    <p class="text-3xl font-black mt-2">{{ $shipment->to_city }}</p>
                </div>
                <div class="border-4 border-black p-6" style="background-color: #4ADE80; box-shadow: 4px 4px 0 #000;">
                    <p class="text-sm font-bold uppercase">Status</p>
                    <p class="text-3xl font-black mt-2">{{ str_replace('_', ' ', $shipment->status) }}</p>
                </div>
                <div class="border-4 border-black p-6" style="background-color: #EC4899; box-shadow: 4px 4px 0 #000;">
                    <p class="text-sm font-bold uppercase">Courier Type</p>
                    <p class="text-3xl font-black mt-2">{{ ucfirst($shipment->courier_type) }}</p>
                </div>
            </div>
        </div>
    </div>
    <script>window.print();</script>
</body>
</html>