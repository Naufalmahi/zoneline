<x-app-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>

    <!-- Top Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-card class="border-l-4 border-l-primary">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-primary">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="mb-1 text-sm font-medium text-gray-500">Order Hari Ini</p>
                    <h3 class="text-2xl font-bold text-gray-800">24</h3>
                </div>
            </div>
        </x-card>
        
        <x-card class="border-l-4 border-l-success">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-success">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="mb-1 text-sm font-medium text-gray-500">Pendapatan Hari Ini</p>
                    <h3 class="text-2xl font-bold text-gray-800">Rp 450.000</h3>
                </div>
            </div>
        </x-card>

        <x-card class="border-l-4 border-l-warning">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-orange-100 text-warning">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="mb-1 text-sm font-medium text-gray-500">Belum Bayar (Piutang)</p>
                    <h3 class="text-2xl font-bold text-gray-800">Rp 120.000</h3>
                </div>
            </div>
        </x-card>

        <x-card class="border-l-4 border-l-danger">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-danger">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="mb-1 text-sm font-medium text-gray-500">Selesai Belum Diambil</p>
                    <h3 class="text-2xl font-bold text-gray-800">8</h3>
                </div>
            </div>
        </x-card>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Recent Orders (Spans 2 columns) -->
        <div class="lg:col-span-2">
            <x-card>
                <x-slot name="header">
                    <div class="flex justify-between items-center">
                        <h3 class="font-heading font-semibold text-lg">Order Terbaru</h3>
                        <a href="#" class="text-sm font-medium text-primary hover:underline">Lihat Semua</a>
                    </div>
                </x-slot>
                
                <div class="overflow-x-auto -mx-6 -my-6">
                    <x-table>
                        <x-slot name="header">
                            <th scope="col" class="px-6 py-3">Invoice</th>
                            <th scope="col" class="px-6 py-3">Pelanggan</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Total</th>
                        </x-slot>
                        
                        <!-- Dummy Row 1 -->
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">INV-26-001</td>
                            <td class="px-6 py-4">Budi Santoso</td>
                            <td class="px-6 py-4"><x-badge color="primary">Washing</x-badge></td>
                            <td class="px-6 py-4">Rp 45.000</td>
                        </tr>
                        <!-- Dummy Row 2 -->
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">INV-26-002</td>
                            <td class="px-6 py-4">Siti Aisyah</td>
                            <td class="px-6 py-4"><x-badge color="success">Ready</x-badge></td>
                            <td class="px-6 py-4">Rp 120.000</td>
                        </tr>
                        <!-- Dummy Row 3 -->
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">INV-26-003</td>
                            <td class="px-6 py-4">Andi Wijaya</td>
                            <td class="px-6 py-4"><x-badge color="warning">Received</x-badge></td>
                            <td class="px-6 py-4">Rp 30.000</td>
                        </tr>
                    </x-table>
                </div>
            </x-card>
        </div>

        <!-- Recent Activities (Spans 1 column) -->
        <div>
            <x-card>
                <x-slot name="header">
                    <h3 class="font-heading font-semibold text-lg">Aktivitas Terakhir</h3>
                </x-slot>

                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        <li>
                            <div class="relative pb-8">
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center ring-8 ring-white">
                                            <svg class="h-4 w-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Order <span class="font-medium text-gray-900">INV-26-004</span> ditambahkan oleh Kasir</p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                            <time datetime="2020-09-20">5 mnt lalu</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <li>
                            <div class="relative pb-8">
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center ring-8 ring-white">
                                            <svg class="h-4 w-4 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Pembayaran <span class="font-medium text-gray-900">INV-26-002</span> Rp 120.000 via QRIS</p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                            <time datetime="2020-09-20">15 mnt lalu</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </x-card>
        </div>

    </div>
</x-app-layout>
