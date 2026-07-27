<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($currentTenant) ? $currentTenantSettings->business_name ?? $currentTenant->name : 'Zoneline' }} - Dashboard</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS and Alpine.js via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom CSS -->
    <style>
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
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    Zoneline
                </a>
            </div>

            <div class="overflow-y-auto overflow-x-hidden flex-grow px-4 py-6 space-y-1">
                @php
                    $menus = [
                        ['route' => 'owner.dashboard', 'label' => 'Dashboard', 'icon' => 'home'],
                        ['route' => 'owner.orders.index', 'label' => 'Orders', 'icon' => 'shopping-bag'],
                        ['route' => 'owner.customers.index', 'label' => 'Customers', 'icon' => 'users'],
                        ['route' => 'owner.services.index', 'label' => 'Services', 'icon' => 'tag'],
                        ['route' => 'owner.payments.index', 'label' => 'Payments', 'icon' => 'credit-card'],
                        ['route' => 'owner.reports.index', 'label' => 'Reports', 'icon' => 'chart-bar'],
                        ['route' => 'owner.employees.index', 'label' => 'Employees', 'icon' => 'briefcase'],
                        ['route' => 'owner.settings.index', 'label' => 'Settings', 'icon' => 'cog'],
                    ];
                @endphp

                @foreach($menus as $menu)
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition {{ request()->routeIs($menu['route']) ? 'bg-primary/10 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <!-- Placeholder SVG -->
                        <div class="w-5 h-5 bg-gray-300 rounded-sm"></div>
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
                        <p class="text-sm font-semibold">{{ auth()->user()->name ?? 'Owner' }}</p>
                        <p class="text-xs text-gray-500">{{ isset($currentTenant) ? $currentTenantSettings->business_name ?? $currentTenant->name : 'No Tenant' }}</p>
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
