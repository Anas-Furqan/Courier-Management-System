<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print - {{ $shipment->tracking_number }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-950 text-slate-100">
    <div class="mx-auto max-w-4xl p-8">
        <div class="rounded-3xl border border-white/10 bg-white/5 p-8">
            <h1 class="text-3xl font-black">Tracking Slip</h1>
            <p class="mt-2 text-slate-300">{{ $shipment->tracking_number }}</p>
            <div class="mt-6 grid gap-4 md:grid-cols-2">
                <div class="glass-panel p-4"><p class="stat-label">From</p><p class="stat-value">{{ $shipment->from_city }}</p></div>
                <div class="glass-panel p-4"><p class="stat-label">To</p><p class="stat-value">{{ $shipment->to_city }}</p></div>
                <div class="glass-panel p-4"><p class="stat-label">Status</p><p class="stat-value">{{ str_replace('_', ' ', $shipment->status) }}</p></div>
                <div class="glass-panel p-4"><p class="stat-label">Courier Type</p><p class="stat-value">{{ ucfirst($shipment->courier_type) }}</p></div>
            </div>
        </div>
    </div>
    <script>window.print();</script>
</body>
</html>