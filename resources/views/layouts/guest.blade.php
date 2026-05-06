<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DeliverIt') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #FEF3C7;
            background-image:
                linear-gradient(rgba(0,0,0,0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,0,0,0.08) 1px, transparent 1px);
            background-size: 32px 32px;
        }
    </style>
</head>
<body class="text-black font-sans min-h-screen">

    {{-- Nav Strip --}}
    <nav class="border-b-4 border-black bg-white/80 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-yellow-300 border-4 border-black flex items-center justify-center font-black text-sm" style="box-shadow:3px 3px 0 #000;">DI</div>
                <span class="font-black text-lg">DeliverIt</span>
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}" class="neo-btn-sm bg-white text-black">Login</a>
                <a href="{{ route('register') }}" class="neo-btn-sm bg-black text-white">Register</a>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <div class="flex items-start justify-center px-4 py-12 min-h-[calc(100vh-68px)]">
        <div class="w-full max-w-2xl">

            {{-- Logo Header --}}
            <div class="text-center mb-8">
                <div class="inline-block mb-4">
                    <div class="w-16 h-16 bg-yellow-300 border-4 border-black flex items-center justify-center font-black text-2xl mx-auto" style="box-shadow:5px 5px 0 #000;">DI</div>
                </div>
                <h1 class="text-3xl font-black">DeliverIt</h1>
                <p class="font-bold text-gray-700 mt-1">Courier Management System</p>
            </div>

            @yield('content')
        </div>
    </div>

</body>
</html>
