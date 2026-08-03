<x-app-layout>
    <x-slot name="title">Laporan Penjualan</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold font-heading text-gray-900">Laporan Transaksi & Pendapatan</h1>
            <p class="text-gray-500 text-sm mt-1">Pantau performa bisnis dan pertumbuhan pendapatan Anda.</p>
        </div>
    </div>

    <!-- Coming Soon Style for now -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-xl p-8 mb-6 relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-xl font-bold text-gray-900 mb-2">Ringkasan Keseluruhan</h2>
            <div class="flex gap-12 mt-6">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Total Pendapatan (Paid)</p>
                    <p class="text-3xl font-bold text-primary">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Total Pesanan Selesai</p>
                    <p class="text-3xl font-bold text-gray-800">{{ number_format($totalOrders) }} <span class="text-sm font-normal text-gray-500">transaksi</span></p>
                </div>
            </div>
        </div>
        <svg class="absolute right-0 bottom-0 opacity-10" width="300" height="200" fill="currentColor" viewBox="0 0 100 100"><path d="M0,100 L100,100 L100,0 C100,55.228 55.228,100 0,100 Z" class="text-primary"></path></svg>
    </div>

    <x-card>
        <h3 class="text-lg font-bold font-heading text-gray-900 mb-4">Fitur Chart & Filter Laporan Lanjut</h3>
        <p class="text-gray-600 mb-6">Fitur grafik penjualan bulanan, export ke Excel/PDF, dan filter tanggal spesifik sedang dalam antrean rilis. Untuk saat ini, gunakan data ringkasan di atas atau unduh data transaksi dari halaman Pesanan.</p>
        <a href="{{ route('owner.orders.index') }}" class="text-primary hover:underline font-medium">Buka Halaman Pesanan &rarr;</a>
    </x-card>
</x-app-layout>
