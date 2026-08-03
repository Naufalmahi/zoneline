<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($currentTenant) ? $currentTenantSettings->business_name ?? $currentTenant->name : 'Zoneline' }} - Dashboard</title>

    <!-- Google Fonts -->
    @php
        $selectedFont = isset($currentTenantSettings) ? $currentTenantSettings->font_family : 'Inter';
        $fontQuery = str_replace(' ', '+', $selectedFont);
    @endphp
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&family={{ $fontQuery }}:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS and Alpine.js via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom CSS -->
    <style>
        :root {
            --color-primary: {{ isset($currentTenantSettings) ? $currentTenantSettings->primary_color : '#2563EB' }};
            --font-primary: '{{ isset($currentTenantSettings) ? $currentTenantSettings->font_family : 'Inter' }}', sans-serif;
        }
        body { font-family: var(--font-primary); }
        [x-cloak] { display: none !important; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="font-sans text-body bg-background antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar (Desktop & Mobile) -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto flex flex-col"
            :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
            
            <div class="flex items-center justify-center h-16 border-b border-gray-100">
                <a href="#" class="text-2xl font-heading font-bold text-primary flex items-center gap-2">
                    @if(isset($currentTenantSettings) && $currentTenantSettings->logo)
                        @php
                            $logoPath = str_starts_with($currentTenantSettings->logo, 'uploads/') 
                                ? asset($currentTenantSettings->logo) 
                                : asset('storage/' . $currentTenantSettings->logo);
                        @endphp
                        <img src="{{ $logoPath }}" alt="Logo" class="w-8 h-8 object-contain">
                    @else
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    @endif
                    <span class="truncate max-w-[150px]">{{ isset($currentTenant) ? $currentTenantSettings->business_name ?? $currentTenant->name : 'Zoneline' }}</span>
                </a>
            </div>

            <div class="overflow-y-auto overflow-x-hidden flex-grow px-4 py-6 space-y-1">
                @php
                    $isSuperAdmin = auth()->check() && auth()->user()->isSuperAdmin();
                    $niche = isset($currentTenant) ? $currentTenant->niche : 'laundry';
                    $menus = [];

                    if ($isSuperAdmin) {
                        $menus = [
                            ['route' => 'superadmin.dashboard', 'label' => 'Dashboard', 'icon' => 'home'],
                            ['route' => 'superadmin.tenants.index', 'label' => 'Tenants', 'icon' => 'users'], 
                            ['route' => 'superadmin.billing.index', 'label' => 'Billing', 'icon' => 'credit-card'],
                        ];
                    } else {
                        if ($niche === 'coffee') {
                            $menus = [
                                ['route' => 'owner.dashboard', 'label' => 'Dashboard', 'icon' => 'home'],
                                ['route' => 'owner.menus.index', 'label' => 'Menu', 'icon' => 'tag'],
                                ['route' => 'owner.tables.index', 'label' => 'Meja', 'icon' => 'users'],
                                ['route' => 'owner.reservations.index', 'label' => 'Reservasi', 'icon' => 'calendar'],
                                ['route' => 'owner.orders.index', 'label' => 'Pesanan', 'icon' => 'shopping-bag'],
                                ['route' => 'owner.reports.index', 'label' => 'Laporan', 'icon' => 'chart-bar'],
                                ['route' => 'owner.roles.index', 'label' => 'Role & Karyawan', 'icon' => 'briefcase'],
                                ['route' => 'owner.settings.index', 'label' => 'Pengaturan', 'icon' => 'cog'],
                            ];
                        } elseif ($niche === 'barbershop') {
                            $menus = [
                                ['route' => 'owner.dashboard', 'label' => 'Dashboard', 'icon' => 'home'],
                                ['route' => 'owner.bookings.index', 'label' => 'Booking', 'icon' => 'calendar'],
                                ['route' => 'owner.barbers.index', 'label' => 'Jadwal Barber', 'icon' => 'users'],
                                ['route' => 'owner.services.index', 'label' => 'Layanan', 'icon' => 'tag'],
                                ['route' => 'owner.orders.index', 'label' => 'Kasir', 'icon' => 'shopping-bag'],
                                ['route' => 'owner.reports.index', 'label' => 'Laporan', 'icon' => 'chart-bar'],
                                ['route' => 'owner.roles.index', 'label' => 'Role & Karyawan', 'icon' => 'briefcase'],
                                ['route' => 'owner.settings.index', 'label' => 'Pengaturan', 'icon' => 'cog'],
                            ];
                        } else {
                            // Laundry
                            $menus = [
                                ['route' => 'owner.dashboard', 'label' => 'Dashboard', 'icon' => 'home'],
                                ['route' => 'owner.orders.index', 'label' => 'Order Laundry', 'icon' => 'shopping-bag'],
                                ['route' => 'owner.customers.index', 'label' => 'Pelanggan', 'icon' => 'users'],
                                ['route' => 'owner.services.index', 'label' => 'Layanan', 'icon' => 'tag'],
                                ['route' => 'owner.reports.index', 'label' => 'Laporan', 'icon' => 'chart-bar'],
                                ['route' => 'owner.roles.index', 'label' => 'Role & Karyawan', 'icon' => 'briefcase'],
                                ['route' => 'owner.settings.index', 'label' => 'Pengaturan', 'icon' => 'cog'],
                            ];
                        }
                    }
                @endphp

                @foreach($menus as $menu)
                    <a href="{{ Route::has($menu['route']) ? route($menu['route']) : '#' }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition {{ request()->routeIs($menu['route']) ? 'bg-primary/10 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        @switch($menu['icon'])
                            @case('home')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                @break
                            @case('users')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                @break
                            @case('credit-card')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                @break
                            @case('tag')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                @break
                            @case('calendar')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                @break
                            @case('shopping-bag')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                @break
                            @case('chart-bar')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                @break
                            @case('briefcase')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                @break
                            @case('cog')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                @break
                            @default
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        @endswitch
                        {{ $menu['label'] }}
                    </a>
                @endforeach
            </div>

            <div class="p-4 border-t border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-3 py-2 w-full text-left text-danger font-medium hover:bg-red-50 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Overlay for Mobile -->
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-40 bg-gray-900/50 lg:hidden" @click="sidebarOpen = false"></div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Topbar -->
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 sm:px-6 z-30">
                <div class="flex items-center">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-700 focus:outline-none lg:hidden mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h2 class="text-xl font-heading font-semibold text-gray-800">{{ $title ?? 'Dashboard' }}</h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="hidden sm:block text-right">
                        <p class="text-sm font-semibold">{{ auth()->user()->name ?? 'Guest' }}</p>
                        <p class="text-xs text-gray-500">{{ isset($isSuperAdmin) && $isSuperAdmin ? 'Super Administrator' : (isset($currentTenant) ? ($currentTenantSettings->business_name ?? $currentTenant->name) : 'No Tenant') }}</p>
                    </div>
                    <!-- Avatar -->
                    <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold">
                        {{ substr(auth()->user()->name ?? 'O', 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-background p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>

        </div>
    </div>

</body>
</html>
