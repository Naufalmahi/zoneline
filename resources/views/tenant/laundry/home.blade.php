<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings->business_name ?? $tenant->name }} - Layanan Laundry Profesional</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&family=Roboto:wght@400;500;700&family=Outfit:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --color-primary: {{ $settings->primary_color ?? '#2563EB' }};
            --font-primary: '{{ $settings->font_family ?? 'Inter' }}', sans-serif;
        }
        body { font-family: var(--font-primary); }
    </style>
</head>
<body class="bg-blue-50/30 text-gray-800 antialiased">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-gray-100 py-4 px-6 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                @if($settings->logo)
                    <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo" class="w-10 h-10 object-contain rounded-full">
                @endif
                <h1 class="text-2xl font-bold" style="color: var(--color-primary)">{{ $settings->business_name ?? $tenant->name }}</h1>
            </div>
            <div class="hidden md:flex gap-6 font-medium text-gray-600">
                <a href="#" class="hover:text-primary transition" style="color: var(--color-primary);">Beranda</a>
                <a href="#" class="hover:text-primary transition">Layanan</a>
                <a href="{{ route('track.index') }}" class="hover:text-primary transition font-semibold text-gray-900">Cek Resi</a>
                <a href="#" class="hover:text-primary transition">Harga</a>
            </div>
            <button class="bg-primary text-white px-5 py-2 rounded-full font-medium shadow-sm hover:opacity-90 transition" style="background-color: var(--color-primary)">
                Order Laundry
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="py-20 px-6 text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-5xl font-extrabold mb-6 text-gray-900 leading-tight">Pakaian Bersih, Hidup Lebih Mudah</h2>
            <p class="text-xl text-gray-500 mb-10">Serahkan urusan cuci mencuci kepada ahlinya di <span class="font-semibold text-gray-800">{{ $settings->business_name ?? $tenant->name }}</span>. Gratis jemput-antar!</p>
            <a href="#" class="inline-block text-white px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition transform" style="background-color: var(--color-primary)">
                Minta Penjemputan
            </a>
        </div>
    </header>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-center mt-20">
        <p>&copy; {{ date('Y') }} {{ $settings->business_name ?? $tenant->name }}. Ditenagai oleh Zoneline.</p>
    </footer>
</body>
</html>
