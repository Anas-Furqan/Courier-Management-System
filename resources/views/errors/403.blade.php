<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 — Access Denied</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-yellow-300 min-h-screen flex items-center justify-center px-4 py-10"
      style="background-image: linear-gradient(rgba(0,0,0,0.06) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,0.06) 1px, transparent 1px); background-size: 32px 32px;">

    <div class="max-w-lg w-full">

        {{-- Brand --}}
        <div class="flex items-center gap-3 mb-8 justify-center">
            <div class="w-11 h-11 bg-black flex items-center justify-center font-black text-yellow-300 text-sm border-4 border-black" style="box-shadow:3px 3px 0 rgba(0,0,0,0.3);">DI</div>
            <span class="font-black text-xl">DeliverIt</span>
        </div>

        <div class="neo-card-xl p-12 bg-white text-center">
            <p class="text-8xl font-black text-red-500 leading-none mb-4">403</p>
            <h1 class="text-3xl font-black mb-3">Access Denied</h1>
            <p class="font-bold text-gray-600 mb-10">You don't have permission to view this page.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a class="neo-btn bg-blue-500 text-white py-3 px-8" href="{{ route('dashboard') }}">Go to Dashboard</a>
                <a class="neo-btn bg-gray-200 text-black py-3 px-8" href="{{ url('/') }}">Back to Home</a>
            </div>
        </div>

    </div>
</body>
</html>
