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
        .neo-btn {
            @apply border-4 border-black font-black uppercase tracking-wider transition-all;
            box-shadow: 6px 6px 0 0 #000;
        }
        .neo-btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 8px 8px 0 0 #000;
        }
        .neo-card {
            @apply border-4 border-black p-6;
            box-shadow: 6px 6px 0 0 #000;
        }
        .neo-input {
            @apply border-4 border-black px-4 py-3 font-bold;
            box-shadow: 4px 4px 0 0 #000;
        }
        .neo-input:focus {
            outline: none !important;
            box-shadow: inset 2px 2px 0 0 rgba(0,0,0,0.1), 6px 6px 0 0 #000 !important;
        }
        .sidebar-nav a {
            @apply block px-4 py-3 font-bold border-b-2 border-gray-300 hover:bg-gray-100;
        }
        .sidebar-nav a.active {
            @apply bg-yellow-300 border-b-4 border-black;
        }
    </style>
</head>
<body class="bg-white text-black font-sans">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="hidden md:flex w-64 border-r-4 border-black flex-col">
            <div class="border-b-4 border-black p-6">
                <a href="/" class="flex items-center gap-2 mb-4">
                    <div class="w-12 h-12 bg-yellow-400 border-4 border-black flex items-center justify-center font-black text-sm" style="box-shadow: 4px 4px 0 #000;">
                        DI
                    </div>
                    <span class="font-black text-lg">DeliverIt</span>
                </a>
            </div>

            <nav class="flex-1 sidebar-nav">
                <a href="{{ route('dashboard') }}" class="{{ Route::currentRouteName() === 'dashboard' ? 'active' : '' }}">📊 Dashboard</a>
                
                @if(auth()->user()->isAdmin())
                    <div class="px-4 py-3 font-black text-sm uppercase text-gray-600 bg-gray-100">Shipments</div>
                    <a href="{{ route('couriers.index') }}" class="{{ Route::currentRouteName() === 'couriers.index' ? 'active' : '' }}">📦 All Shipments</a>
                    <a href="{{ route('couriers.create') }}" class="{{ Route::currentRouteName() === 'couriers.create' ? 'active' : '' }}">➕ New Shipment</a>
                    
                    <div class="px-4 py-3 font-black text-sm uppercase text-gray-600 bg-gray-100">Management</div>
                    <a href="{{ route('admin.agents.index') }}" class="{{ Route::currentRouteName() === 'admin.agents.index' ? 'active' : '' }}">👥 Agents</a>
                    <a href="{{ route('admin.customers.index') }}" class="{{ Route::currentRouteName() === 'admin.customers.index' ? 'active' : '' }}">🏢 Customers</a>
                    
                    <div class="px-4 py-3 font-black text-sm uppercase text-gray-600 bg-gray-100">Reports</div>
                    <a href="{{ route('admin.reports.index') }}" class="{{ Route::currentRouteName() === 'admin.reports.index' ? 'active' : '' }}">📈 View Reports</a>
                    <a href="{{ route('admin.reports.create') }}" class="{{ Route::currentRouteName() === 'admin.reports.create' ? 'active' : '' }}">📊 Generate Report</a>
                @elseif(auth()->user()->isAgent())
                    <div class="px-4 py-3 font-black text-sm uppercase text-gray-600 bg-gray-100">Shipments</div>
                    <a href="{{ route('agent.couriers.index') }}" class="{{ Route::currentRouteName() === 'agent.couriers.index' ? 'active' : '' }}">📦 All Shipments</a>
                    <a href="{{ route('agent.couriers.create') }}" class="{{ Route::currentRouteName() === 'agent.couriers.create' ? 'active' : '' }}">➕ New Shipment</a>
                    
                    <div class="px-4 py-3 font-black text-sm uppercase text-gray-600 bg-gray-100">Reports</div>
                    <a href="{{ route('agent.reports.index') }}" class="{{ Route::currentRouteName() === 'agent.reports.index' ? 'active' : '' }}">📈 View Reports</a>
                    <a href="{{ route('agent.reports.create') }}" class="{{ Route::currentRouteName() === 'agent.reports.create' ? 'active' : '' }}">📊 Generate Report</a>
                @else
                    <div class="px-4 py-3 font-black text-sm uppercase text-gray-600 bg-gray-100">Quick Actions</div>
                    <a href="{{ route('track.search') }}" class="{{ Route::currentRouteName() === 'track.search' ? 'active' : '' }}">🔍 Track Shipment</a>
                    <a href="{{ route('customer.shipments') }}" class="{{ Route::currentRouteName() === 'customer.shipments' ? 'active' : '' }}">📬 My Shipments</a>
                @endif
            </nav>

            <div class="border-t-4 border-black p-4">
                <a href="{{ route('profile') }}" class="block px-4 py-2 mb-2 bg-blue-300 border-2 border-black font-bold text-center">👤 Profile</a>
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white font-bold border-2 border-black">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col">
            <!-- Mobile Header -->
            <header class="md:hidden sticky top-0 z-50 border-b-4 border-black bg-white">
                <div class="px-6 py-4">
                    <div class="flex justify-between items-center">
                        <a href="/" class="flex items-center gap-2">
                            <div class="w-10 h-10 bg-yellow-400 border-4 border-black flex items-center justify-center font-black text-xs" style="box-shadow: 3px 3px 0 #000;">
                                DI
                            </div>
                        </a>
                        <span class="text-sm font-bold">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white font-bold border-2 border-black text-xs">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 container mx-auto px-6 py-12">
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-300 border-4 border-black font-bold" style="box-shadow: 4px 4px 0 #000;">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-300 border-4 border-black font-bold" style="box-shadow: 4px 4px 0 #000;">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="border-t-4 border-black bg-gray-100 py-8">
                <div class="container mx-auto px-6 text-center font-bold">
                    <p>© 2026 DeliverIt Courier Management System. All rights reserved.</p>
                </div>
            </footer>
        </main>
    </div>
</body>
</html>