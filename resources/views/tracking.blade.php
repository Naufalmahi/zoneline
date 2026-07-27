<x-guest-layout>
    <div class="min-h-[calc(100vh-140px)] flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-heading font-extrabold text-gray-900">Cek Status Cucian</h1>
            <p class="mt-2 text-gray-500">Masukkan nomor invoice Anda untuk melacak status pakaian</p>
        </div>

        <x-card class="max-w-xl w-full p-6 sm:p-8 shadow-xl">
            <form action="" method="GET" class="flex gap-4">
                <div class="flex-1">
                    <x-input type="text" name="invoice" placeholder="Contoh: INV-26-001" class="text-lg py-3" />
                </div>
                <x-button type="submit" variant="primary" class="py-3 px-6 text-lg">
                    Lacak
                </x-button>
            </form>
            
            <!-- Result Placeholder (Normally conditional based on request) -->
            <div class="mt-10 border-t border-gray-100 pt-8" x-data="{ found: true }">
                <template x-if="found">
                    <div>
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-xl font-heading font-bold text-gray-900">INV-26-001</h3>
                                <p class="text-gray-500">Budi Santoso &bull; Cuci Setrika Express</p>
                            </div>
                            <x-badge color="primary">Washing</x-badge>
                        </div>

                        <!-- Timeline -->
                        <div class="relative mt-8">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t-2 border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-between">
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-primary flex items-center justify-center ring-4 ring-white">
                                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    </span>
                                    <span class="absolute -bottom-6 -ml-3 text-xs font-medium text-primary">Received</span>
                                </div>
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-blue-200 flex items-center justify-center ring-4 ring-white">
                                        <div class="h-2.5 w-2.5 rounded-full bg-primary"></div>
                                    </span>
                                    <span class="absolute -bottom-6 -ml-3 text-xs font-medium text-primary">Washing</span>
                                </div>
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center ring-4 ring-white"></span>
                                    <span class="absolute -bottom-6 -ml-3 text-xs font-medium text-gray-500">Ready</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-12 bg-blue-50 rounded-lg p-4 flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500">Estimasi Selesai</p>
                                <p class="font-bold text-gray-900">Besok, 18.00 WIB</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Tagihan</p>
                                <p class="font-bold text-primary">Rp 45.000</p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </x-card>

    </div>
</x-guest-layout>
