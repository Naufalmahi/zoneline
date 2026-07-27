<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Zoneline') }} - Software SaaS Manajemen Laundry</title>

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
<body class="font-sans text-body bg-background antialiased selection:bg-primary selection:text-white">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-gray-100 fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-heading font-bold text-primary flex items-center gap-2">
                        <!-- Icon Placeholder -->
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        Zoneline
                    </a>
                </div>
                <div class="hidden sm:flex sm:items-center sm:gap-6">
                    <a href="{{ route('track.index') }}" class="text-gray-500 hover:text-primary transition font-medium">Cek Resi</a>
                    @auth
                        <a href="{{ route('owner.dashboard') }}" class="text-gray-500 hover:text-primary transition font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-500 hover:text-primary transition font-medium">Login</a>
                        <a href="{{ route('register') }}" class="bg-primary text-white px-5 py-2 rounded-lg font-semibold hover:bg-blue-700 transition shadow-sm">Daftar Gratis</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-16">
        {{ $slot }}
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-20">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 text-center text-gray-500">
            <p>&copy; {{ date('Y') }} Zoneline. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
