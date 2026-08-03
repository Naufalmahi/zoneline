<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings->business_name ?? $tenant->name }} - Barbershop Premium</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&family=Roboto:wght@400;500;700&family=Outfit:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --color-primary: {{ $settings->primary_color ?? '#111827' }}; /* Default dark for barber */
            --font-primary: '{{ $settings->font_family ?? 'Outfit' }}', sans-serif;
        }
        body { font-family: var(--font-primary); }
    </style>
</head>
<body class="bg-zinc-900 text-gray-200 antialiased">
    <!-- Navbar -->
    <nav class="bg-zinc-950 shadow-sm border-b border-zinc-800 py-4 px-6 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                @if($settings->logo)
                    <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo" class="w-10 h-10 object-contain rounded-full">
                @endif
                <h1 class="text-2xl font-bold uppercase tracking-wider" style="color: var(--color-primary)">{{ $settings->business_name ?? $tenant->name }}</h1>
            </div>
            <div class="hidden md:flex gap-6 font-medium text-zinc-400">
                <a href="#" class="hover:text-white transition" style="color: var(--color-primary);">Beranda</a>
                <a href="#" class="hover:text-white transition">Barber Kami</a>
                <a href="#" class="hover:text-white transition">Harga Layanan</a>
                <a href="#" class="hover:text-white transition">Galeri</a>
            </div>
            <button class="text-zinc-900 px-5 py-2 rounded font-bold shadow-sm hover:opacity-90 transition" style="background-color: var(--color-primary)">
                Booking Sekarang
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="py-24 px-6 text-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, #fff 10px, #fff 20px);"></div>
        <div class="max-w-3xl mx-auto relative z-10">
            <h2 class="text-5xl sm:text-6xl font-extrabold mb-6 text-white uppercase tracking-tight">Tampil Keren Setiap Saat</h2>
            <p class="text-xl text-zinc-400 mb-10">Percayakan gaya rambut Anda pada capster profesional di <span class="font-semibold text-white">{{ $settings->business_name ?? $tenant->name }}</span>.</p>
            <a href="#" class="inline-block text-zinc-900 px-10 py-4 rounded font-bold uppercase tracking-widest shadow-lg hover:-translate-y-1 transition transform" style="background-color: var(--color-primary)">
                Pilih Jadwal
            </a>
        </div>
    </header>

    <!-- Footer -->
    <footer class="bg-black text-zinc-600 py-8 text-center border-t border-zinc-800">
        <p>&copy; {{ date('Y') }} {{ $settings->business_name ?? $tenant->name }}. Ditenagai oleh Zoneline.</p>
    </footer>
</body>
</html>
