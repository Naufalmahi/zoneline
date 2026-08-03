<x-app-layout>
    <x-slot name="title">Manajemen Billing</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold font-heading text-gray-900">Manajemen Billing & Tagihan</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola seluruh invoice pembayaran langganan SaaS dari tenant.</p>
        </div>
    </div>

    <!-- Coming Soon Banner -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-8 text-center max-w-3xl mx-auto mt-10">
        <div class="w-16 h-16 bg-blue-100 text-primary rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
        </div>
        <h2 class="text-xl font-bold font-heading text-gray-900 mb-2">Modul Billing Sedang Dalam Pengembangan</h2>
        <p class="text-gray-600 mb-6">Fitur ini akan segera hadir pada update berikutnya. Modul ini akan terintegrasi langsung dengan payment gateway (Midtrans/Xendit) untuk penagihan otomatis biaya langganan SaaS ke setiap tenant.</p>
        
        <a href="{{ route('superadmin.dashboard') }}" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-lg font-medium hover:opacity-90 transition shadow-lg">
            Kembali ke Dashboard
        </a>
    </div>

</x-app-layout>
