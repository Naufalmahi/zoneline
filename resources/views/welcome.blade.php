<x-guest-layout>
    <!-- Hero Section -->
    <div class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 pt-20">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-heading font-extrabold text-gray-900 sm:text-5xl md:text-6xl leading-tight">
                            <span class="block xl:inline">Kelola Laundry Lebih Mudah Bersama</span>
                            <span class="block text-primary">Zoneline</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Semua pencatatan laundry menjadi digital. Tinggalkan buku tulis dan beralih ke platform cloud modern khusus untuk UMKM.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start gap-4">
                            <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-semibold rounded-lg text-white bg-primary hover:bg-blue-700 md:py-4 md:text-lg md:px-10 shadow-lg hover:shadow-xl transition-all">
                                Daftar Gratis
                            </a>
                            <a href="#" class="mt-3 w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-semibold rounded-lg text-primary bg-blue-100 hover:bg-blue-200 md:py-4 md:text-lg md:px-10 md:mt-0 transition-all">
                                Coba Demo
                            </a>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full opacity-90" src="https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="Laundry Operations">
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-heading font-extrabold text-gray-900">Kenapa Memilih Zoneline?</h2>
                <p class="mt-4 text-lg text-gray-500">Dirancang khusus untuk membantu pemilik laundry agar lebih fokus mengembangkan bisnis.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <x-card class="text-center p-8 hover:-translate-y-1 hover:shadow-lg transition-transform duration-300">
                    <div class="w-16 h-16 bg-blue-100 text-primary rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-heading font-semibold mb-3">Input Order Cepat</h3>
                    <p class="text-gray-500">Sistem POS yang dirancang untuk kecepatan. Tambah order pelanggan kurang dari 30 detik.</p>
                </x-card>
                
                <!-- Feature 2 -->
                <x-card class="text-center p-8 hover:-translate-y-1 hover:shadow-lg transition-transform duration-300">
                    <div class="w-16 h-16 bg-green-100 text-success rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-heading font-semibold mb-3">Laporan Keuangan Otomatis</h3>
                    <p class="text-gray-500">Pantau omzet harian, mingguan, hingga bulanan secara real-time tanpa pusing menghitung manual.</p>
                </x-card>
                
                <!-- Feature 3 -->
                <x-card class="text-center p-8 hover:-translate-y-1 hover:shadow-lg transition-transform duration-300">
                    <div class="w-16 h-16 bg-orange-100 text-warning rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-heading font-semibold mb-3">Cek Resi Online</h3>
                    <p class="text-gray-500">Pelanggan Anda dapat melacak status cucian secara mandiri cukup dengan nomor invoice.</p>
                </x-card>
            </div>
        </div>
    </div>

    <!-- Pricing Section -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-heading font-extrabold text-gray-900">Harga Berlangganan</h2>
                <p class="mt-4 text-lg text-gray-500">Pilih paket yang sesuai dengan kebutuhan bisnis laundry Anda.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
                <!-- Basic Plan -->
                <x-card class="p-8 border-2 border-transparent">
                    <h3 class="text-2xl font-heading font-bold mb-2">Basic</h3>
                    <p class="text-gray-500 mb-6">Cocok untuk laundry rintisan</p>
                    <div class="text-4xl font-extrabold text-primary mb-6">Rp 39.000<span class="text-base font-medium text-gray-500">/bln</span></div>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-success mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Unlimited Order</li>
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-success mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Manajemen Pelanggan</li>
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-success mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Cetak Nota (Thermal)</li>
                        <li class="flex items-center text-gray-400"><svg class="w-5 h-5 text-gray-300 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Laporan Ekspor Excel</li>
                        <li class="flex items-center text-gray-400"><svg class="w-5 h-5 text-gray-300 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Akses Karyawan (Multi User)</li>
                    </ul>
                    
                    <x-button variant="secondary" full>Pilih Basic</x-button>
                </x-card>
                
                <!-- Premium Plan -->
                <x-card class="p-8 border-2 border-primary relative transform scale-105 shadow-xl">
                    <div class="absolute top-0 right-0 bg-primary text-white text-xs font-bold px-3 py-1 rounded-bl-lg rounded-tr-lg">POPULER</div>
                    <h3 class="text-2xl font-heading font-bold mb-2">Premium</h3>
                    <p class="text-gray-500 mb-6">Fitur lengkap untuk bisnis berkembang</p>
                    <div class="text-4xl font-extrabold text-primary mb-6">Rp 79.000<span class="text-base font-medium text-gray-500">/bln</span></div>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-success mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Semua Fitur Basic</li>
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-success mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Laporan Keuangan Lengkap & Ekspor</li>
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-success mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Akses Multi Karyawan</li>
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-success mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Notifikasi WhatsApp Otomatis</li>
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-success mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Backup Cloud Aman</li>
                    </ul>
                    
                    <x-button variant="primary" full>Coba Premium 14 Hari</x-button>
                </x-card>
            </div>
        </div>
    </div>
</x-guest-layout>
