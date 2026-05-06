<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DeliverIt') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-black font-sans">

<div class="flex min-h-screen">

    {{-- ═══ DESKTOP SIDEBAR ═══ --}}
    <aside id="desktop-sidebar" class="hidden md:flex w-64 border-r-4 border-black flex-col flex-shrink-0 sticky top-0 h-screen overflow-y-auto">

        {{-- Brand --}}
        <div class="border-b-4 border-black p-5 flex items-center gap-3">
            <div class="w-11 h-11 bg-yellow-300 border-4 border-black flex items-center justify-center font-black text-sm flex-shrink-0" style="box-shadow:3px 3px 0 #000;">DI</div>
            <a href="/" class="font-black text-lg leading-tight">DeliverIt</a>
        </div>

        {{-- User Badge --}}
        <div class="border-b-4 border-black px-5 py-4 bg-gray-50">
            <p class="text-xs font-black uppercase tracking-widest text-gray-500 mb-1">Logged in as</p>
            <p class="font-black text-sm truncate">{{ auth()->user()->name }}</p>
            <span class="inline-block mt-1 px-2 py-0.5 text-xs font-black uppercase border-2 border-black
                @if(auth()->user()->isAdmin()) bg-purple-300
                @elseif(auth()->user()->isAgent()) bg-cyan-300
                @else bg-yellow-300
                @endif">
                @if(auth()->user()->isAdmin()) Admin
                @elseif(auth()->user()->isAgent()) Agent
                @else Customer
                @endif
            </span>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1">
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ str_starts_with(Route::currentRouteName(), 'dashboard') ? 'active' : '' }}">
                <span class="text-base">📊</span> Dashboard
            </a>

            @if(auth()->user()->isAdmin())
                <div class="sidebar-section">Shipments</div>
                <a href="{{ route('couriers.index') }}" class="sidebar-link {{ Route::currentRouteName() === 'couriers.index' ? 'active' : '' }}">
                    <span>📦</span> All Shipments
                </a>
                <a href="{{ route('couriers.create') }}" class="sidebar-link {{ Route::currentRouteName() === 'couriers.create' ? 'active' : '' }}">
                    <span>➕</span> New Shipment
                </a>

                <div class="sidebar-section">Management</div>
                <a href="{{ route('admin.agents.index') }}" class="sidebar-link {{ str_starts_with(Route::currentRouteName() ?? '', 'admin.agents') ? 'active' : '' }}">
                    <span>👥</span> Agents
                </a>
                <a href="{{ route('admin.customers.index') }}" class="sidebar-link {{ str_starts_with(Route::currentRouteName() ?? '', 'admin.customers') ? 'active' : '' }}">
                    <span>🏢</span> Customers
                </a>

                <div class="sidebar-section">Reports</div>
                <a href="{{ route('admin.reports.index') }}" class="sidebar-link {{ Route::currentRouteName() === 'admin.reports.index' ? 'active' : '' }}">
                    <span>📈</span> View Reports
                </a>
                <a href="{{ route('admin.reports.create') }}" class="sidebar-link {{ Route::currentRouteName() === 'admin.reports.create' ? 'active' : '' }}">
                    <span>📊</span> Generate Report
                </a>

            @elseif(auth()->user()->isAgent())
                <div class="sidebar-section">Shipments</div>
                <a href="{{ route('agent.couriers.index') }}" class="sidebar-link {{ Route::currentRouteName() === 'agent.couriers.index' ? 'active' : '' }}">
                    <span>📦</span> All Shipments
                </a>
                <a href="{{ route('agent.couriers.create') }}" class="sidebar-link {{ Route::currentRouteName() === 'agent.couriers.create' ? 'active' : '' }}">
                    <span>➕</span> New Shipment
                </a>

                <div class="sidebar-section">Reports</div>
                <a href="{{ route('agent.reports.index') }}" class="sidebar-link {{ Route::currentRouteName() === 'agent.reports.index' ? 'active' : '' }}">
                    <span>📈</span> View Reports
                </a>
                <a href="{{ route('agent.reports.create') }}" class="sidebar-link {{ Route::currentRouteName() === 'agent.reports.create' ? 'active' : '' }}">
                    <span>📊</span> Generate Report
                </a>

            @else
                <div class="sidebar-section">Quick Actions</div>
                <a href="{{ route('track.search') }}" class="sidebar-link {{ Route::currentRouteName() === 'track.search' ? 'active' : '' }}">
                    <span>🔍</span> Track Shipment
                </a>
                <a href="{{ route('customer.shipments') }}" class="sidebar-link {{ Route::currentRouteName() === 'customer.shipments' ? 'active' : '' }}">
                    <span>📬</span> My Shipments
                </a>
            @endif
        </nav>

        {{-- Footer Actions --}}
        <div class="border-t-4 border-black p-4 space-y-2">
            <a href="{{ route('profile') }}" class="neo-btn-sm w-full bg-blue-300 text-black text-center block">👤 Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="neo-btn-sm w-full bg-red-500 text-white">Logout</button>
            </form>
        </div>
    </aside>

    {{-- ═══ MAIN CONTENT COLUMN ═══ --}}
    <div class="flex-1 flex flex-col min-w-0">

        {{-- ─── TOP HEADER (mobile only) ─── --}}
        <header class="md:hidden sticky top-0 z-50 border-b-4 border-black bg-white">
            <div class="px-4 py-3 flex items-center justify-between gap-3">
                <button id="sidebar-toggle" class="w-10 h-10 border-2 border-black flex items-center justify-center font-black text-lg" style="box-shadow:2px 2px 0 #000;" aria-label="Menu">☰</button>
                <a href="/" class="flex items-center gap-2">
                    <div class="w-9 h-9 bg-yellow-300 border-4 border-black flex items-center justify-center font-black text-xs" style="box-shadow:2px 2px 0 #000;">DI</div>
                    <span class="font-black">DeliverIt</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-3 py-1 bg-red-500 text-white font-black border-2 border-black text-xs" style="box-shadow:2px 2px 0 #000;">Out</button>
                </form>
            </div>
        </header>

        {{-- ─── DESKTOP PAGE HEADER ─── --}}
        <div class="hidden md:flex items-center justify-between border-b-4 border-black px-8 py-4 bg-white sticky top-0 z-40">
            <div class="flex items-center gap-2 text-sm font-bold text-gray-500">
                <span>@yield('page-title', 'Dashboard')</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('profile') }}" class="neo-btn-sm bg-blue-300 text-black">👤 {{ auth()->user()->name }}</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="neo-btn-sm bg-red-500 text-white">Logout</button>
                </form>
            </div>
        </div>

        {{-- ─── CONTENT AREA ─── --}}
        <main class="flex-1 px-6 py-8 md:px-8 md:py-10">

            @if (session('success'))
                <div class="alert-success mb-6">
                    <span>✓</span> {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert-error mb-6">
                    <span>✕</span> {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>

        {{-- ─── FOOTER ─── --}}
        <footer class="border-t-4 border-black bg-gray-50 py-6 px-8">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-2">
                <p class="font-bold text-sm">© 2026 <span class="font-black">DeliverIt</span> Courier Management System.</p>
                <a href="/" class="text-sm font-bold hover:underline underline-offset-4 decoration-2">← Back to Home</a>
            </div>
        </footer>
    </div>
</div>

{{-- ═══ MOBILE SIDEBAR OVERLAY ═══ --}}
<div id="sidebar-overlay" class="fixed inset-0 bg-black/60 z-40 hidden"></div>

{{-- ═══ MOBILE SIDEBAR ═══ --}}
<aside id="mobile-sidebar" class="md:hidden fixed left-0 top-0 h-screen w-72 bg-white border-r-4 border-black z-50 flex flex-col transition-transform duration-200 -translate-x-full overflow-y-auto">

    {{-- Brand --}}
    <div class="border-b-4 border-black p-5 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 bg-yellow-300 border-4 border-black flex items-center justify-center font-black text-sm" style="box-shadow:3px 3px 0 #000;">DI</div>
            <span class="font-black text-lg">DeliverIt</span>
        </div>
        <button id="sidebar-close" class="w-9 h-9 border-2 border-black flex items-center justify-center font-black" style="box-shadow:2px 2px 0 #000;">✕</button>
    </div>

    {{-- User Badge --}}
    <div class="border-b-4 border-black px-5 py-4 bg-gray-50">
        <p class="text-xs font-black uppercase tracking-widest text-gray-500 mb-1">Logged in as</p>
        <p class="font-black">{{ auth()->user()->name }}</p>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1">
        <a href="{{ route('dashboard') }}" class="sidebar-link {{ str_starts_with(Route::currentRouteName(), 'dashboard') ? 'active' : '' }}">
            <span>📊</span> Dashboard
        </a>

        @if(auth()->user()->isAdmin())
            <div class="sidebar-section">Shipments</div>
            <a href="{{ route('couriers.index') }}" class="sidebar-link {{ Route::currentRouteName() === 'couriers.index' ? 'active' : '' }}"><span>📦</span> All Shipments</a>
            <a href="{{ route('couriers.create') }}" class="sidebar-link {{ Route::currentRouteName() === 'couriers.create' ? 'active' : '' }}"><span>➕</span> New Shipment</a>
            <div class="sidebar-section">Management</div>
            <a href="{{ route('admin.agents.index') }}" class="sidebar-link {{ str_starts_with(Route::currentRouteName() ?? '', 'admin.agents') ? 'active' : '' }}"><span>👥</span> Agents</a>
            <a href="{{ route('admin.customers.index') }}" class="sidebar-link {{ str_starts_with(Route::currentRouteName() ?? '', 'admin.customers') ? 'active' : '' }}"><span>🏢</span> Customers</a>
            <div class="sidebar-section">Reports</div>
            <a href="{{ route('admin.reports.index') }}" class="sidebar-link {{ Route::currentRouteName() === 'admin.reports.index' ? 'active' : '' }}"><span>📈</span> View Reports</a>
            <a href="{{ route('admin.reports.create') }}" class="sidebar-link {{ Route::currentRouteName() === 'admin.reports.create' ? 'active' : '' }}"><span>📊</span> Generate Report</a>
        @elseif(auth()->user()->isAgent())
            <div class="sidebar-section">Shipments</div>
            <a href="{{ route('agent.couriers.index') }}" class="sidebar-link {{ Route::currentRouteName() === 'agent.couriers.index' ? 'active' : '' }}"><span>📦</span> All Shipments</a>
            <a href="{{ route('agent.couriers.create') }}" class="sidebar-link {{ Route::currentRouteName() === 'agent.couriers.create' ? 'active' : '' }}"><span>➕</span> New Shipment</a>
            <div class="sidebar-section">Reports</div>
            <a href="{{ route('agent.reports.index') }}" class="sidebar-link {{ Route::currentRouteName() === 'agent.reports.index' ? 'active' : '' }}"><span>📈</span> View Reports</a>
            <a href="{{ route('agent.reports.create') }}" class="sidebar-link {{ Route::currentRouteName() === 'agent.reports.create' ? 'active' : '' }}"><span>📊</span> Generate Report</a>
        @else
            <div class="sidebar-section">Quick Actions</div>
            <a href="{{ route('track.search') }}" class="sidebar-link {{ Route::currentRouteName() === 'track.search' ? 'active' : '' }}"><span>🔍</span> Track Shipment</a>
            <a href="{{ route('customer.shipments') }}" class="sidebar-link {{ Route::currentRouteName() === 'customer.shipments' ? 'active' : '' }}"><span>📬</span> My Shipments</a>
        @endif
    </nav>

    {{-- Footer Actions --}}
    <div class="border-t-4 border-black p-4 space-y-2">
        <a href="{{ route('profile') }}" class="neo-btn-sm w-full bg-blue-300 text-black text-center block">👤 Profile</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="neo-btn-sm w-full bg-red-500 text-white">Logout</button>
        </form>
    </div>
</aside>

<script>
    (function () {
        const toggle   = document.getElementById('sidebar-toggle');
        const closeBtn = document.getElementById('sidebar-close');
        const sidebar  = document.getElementById('mobile-sidebar');
        const overlay  = document.getElementById('sidebar-overlay');

        function open() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function close() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
        }

        toggle   && toggle.addEventListener('click', open);
        closeBtn && closeBtn.addEventListener('click', close);
        overlay  && overlay.addEventListener('click', close);
        document.addEventListener('keydown', e => e.key === 'Escape' && close());

        sidebar && sidebar.querySelectorAll('a').forEach(a => a.addEventListener('click', close));
    })();
</script>
</body>
</html>
