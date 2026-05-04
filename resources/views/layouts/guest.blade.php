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
            background: linear-gradient(135deg, #fef3c7 0%, #fcd34d 50%, #fef08a 100%);
        }
        .neo-btn {
            @apply border-4 border-black font-black uppercase tracking-wider transition-all;
            box-shadow: 6px 6px 0 0 #000;
        }
        .neo-btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 8px 8px 0 0 #000;
        }
        .neo-btn:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0 0 #000;
        }
        .neo-card {
            @apply border-4 border-black p-8;
            box-shadow: 8px 8px 0 0 #000;
        }
        .neo-input {
            @apply border-4 border-black px-4 py-3 font-bold text-lg;
            box-shadow: 4px 4px 0 0 #000;
        }
        .neo-input:focus {
            outline: none !important;
            box-shadow: inset 2px 2px 0 0 rgba(0,0,0,0.1), 6px 6px 0 0 #000 !important;
        }
    </style>
</head>
<body class="text-black font-sans">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Logo -->
            <div class="text-center mb-12">
                <div class="inline-block">
                    <div class="w-16 h-16 bg-red-500 border-4 border-black flex items-center justify-center font-black text-3xl mb-4" style="box-shadow: 6px 6px 0 #000;">
                        DI
                    </div>
                </div>
                <h1 class="text-4xl font-black mt-4">DeliverIt</h1>
                <p class="text-lg font-bold mt-2">Courier Management System</p>
            </div>

            @yield('content')
        </div>
    </div>
</body>
</html>