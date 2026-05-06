<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DeliverIt') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,900|space-grotesk:400,500,700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])

    <style type="text/tailwindcss">
        @layer base {
            body { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
            h1, h2, h3, h4, h5, h6 { font-family: 'Space Grotesk', 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
        }

        @layer components {
            .neo-btn {
                @apply inline-flex items-center justify-center gap-2 border-4 border-black px-5 py-3 font-black uppercase tracking-wide cursor-pointer select-none;
                box-shadow: 4px 4px 0 0 #000;
                transition: transform .1s, box-shadow .1s;
            }
            .neo-btn:hover  { transform: translate(-2px,-2px); box-shadow: 6px 6px 0 0 #000; }
            .neo-btn:active { transform: translate( 2px, 2px); box-shadow: 2px 2px 0 0 #000; }

            .neo-btn-sm {
                @apply inline-flex items-center justify-center gap-1 border-2 border-black px-3 py-1.5 text-xs font-black uppercase tracking-wide cursor-pointer select-none;
                box-shadow: 3px 3px 0 0 #000;
                transition: transform .1s, box-shadow .1s;
            }
            .neo-btn-sm:hover  { transform: translate(-1px,-1px); box-shadow: 4px 4px 0 0 #000; }
            .neo-btn-sm:active { transform: translate( 1px, 1px); box-shadow: 1px 1px 0 0 #000; }

            .neo-card    { @apply border-4 border-black bg-white; box-shadow: 6px 6px 0 0 #000; }
            .neo-card-xl { @apply border-4 border-black bg-white; box-shadow: 8px 8px 0 0 #000; }

            .neo-input {
                @apply w-full border-4 border-black bg-white px-4 py-3 font-bold text-black placeholder-gray-400;
                box-shadow: 3px 3px 0 0 #000;
                outline: none;
                transition: box-shadow .1s;
            }
            .neo-input:focus { box-shadow: inset 2px 2px 0 0 rgba(0,0,0,.07), 5px 5px 0 0 #000; }

            .form-label { @apply block text-sm font-black uppercase tracking-wide mb-2; }
            .form-error { @apply mt-1 text-sm font-bold text-red-600; }
        }
    </style>

    <style>
        body {
            background-color: #FEF3C7;
            background-image:
                linear-gradient(rgba(0,0,0,0.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,0,0,0.07) 1px, transparent 1px);
            background-size: 32px 32px;
        }
    </style>
</head>
<body class="text-black min-h-screen">

    {{-- Nav strip --}}
    <nav class="border-b-4 border-black bg-white/80" style="backdrop-filter:blur(8px);">
        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-yellow-300 border-4 border-black flex items-center justify-center font-black text-sm"
                     style="box-shadow:3px 3px 0 #000;">DI</div>
                <span class="font-black text-lg">DeliverIt</span>
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}"    class="neo-btn-sm bg-white text-black">Login</a>
                <a href="{{ route('register') }}" class="neo-btn-sm bg-black text-white">Register</a>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <div class="flex items-start justify-center px-4 py-12 min-h-[calc(100vh-68px)]">
        <div class="w-full max-w-2xl">

            {{-- Logo header --}}
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-yellow-300 border-4 border-black flex items-center justify-center font-black text-2xl mx-auto mb-4"
                     style="box-shadow:5px 5px 0 #000;">DI</div>
                <h1 class="text-3xl font-black">DeliverIt</h1>
                <p class="font-bold text-gray-700 mt-1">Courier Management System</p>
            </div>

            @yield('content')
        </div>
    </div>

</body>
</html>
