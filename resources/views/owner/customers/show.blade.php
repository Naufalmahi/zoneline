<x-app-layout>
    <x-slot name="title">Detail Pelanggan {{ $customer->name }}</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('owner.customers.index') }}" class="text-gray-500 hover:text-primary text-sm font-medium flex items-center gap-1">
            &larr; Kembali ke Daftar Pelanggan
        </a>
        <div class="flex gap-2">
            <a href="{{ route('owner.customers.edit', $customer->id) }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-50 transition">
                Edit
            </a>
            <form action="{{ route('owner.customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Hapus pelanggan ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-50 text-red-600 border border-red-200 px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-100 transition">
                    Hapus
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <x-card class="md:col-span-1">
            <div class="text-center pb-4 border-b border-gray-100">
                <div class="w-20 h-20 bg-primary/10 text-primary rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-3">
                    {{ substr($customer->name, 0, 1) }}
                </div>
                <h2 class="text-xl font-bold text-gray-900">{{ $customer->name }}</h2>
                <p class="text-gray-500 text-sm font-mono mt-1">{{ $customer->member_code }}</p>
            </div>
            
            <div class="py-4 space-y-4">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Kontak</p>
                    <p class="text-sm text-gray-900 mt-1">{{ $customer->phone ?? 'Tidak ada nomor HP' }}</p>
                    <p class="text-sm text-gray-900 mt-1">{{ $customer->email ?? 'Tidak ada email' }}</p>
                </div>
                
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Catatan</p>
                    <p class="text-sm text-gray-900 mt-1">{{ $customer->notes ?? '-' }}</p>
                </div>
            </div>
        </x-card>
        
        <x-card class="md:col-span-2">
            <h3 class="text-lg font-bold font-heading text-gray-900 mb-4">Statistik Transaksi</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-blue-50 border border-blue-100 rounded-lg p-4">
                    <p class="text-sm text-blue-600 font-medium mb-1">Total Order</p>
                    <p class="text-2xl font-bold text-blue-900">{{ $customer->total_orders }}</p>
                </div>
                <div class="bg-green-50 border border-green-100 rounded-lg p-4">
                    <p class="text-sm text-green-600 font-medium mb-1">Total Transaksi</p>
                    <p class="text-2xl font-bold text-green-900">Rp {{ number_format($customer->total_spending, 0, ',', '.') }}</p>
                </div>
            </div>
            
            <h3 class="text-lg font-bold font-heading text-gray-900 mt-8 mb-4">Riwayat Order Terakhir</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-2">Invoice</th>
                            <th class="px-4 py-2">Tanggal</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($customer->orders as $order)
                            <tr>
                                <td class="px-4 py-3 font-semibold"><a href="{{ route('owner.orders.show', $order->id) }}" class="text-primary hover:underline">{{ $order->invoice_number }}</a></td>
                                <td class="px-4 py-3">{{ $order->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">
                                    <span class="text-xs font-semibold px-2 py-1 rounded-full" style="background-color: {{ $order->status->color_hex ?? '#eee' }}22; color: {{ $order->status->color_hex ?? '#888' }}">
                                        {{ $order->status->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 font-medium">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-400">Belum ada order.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>
</x-app-layout>
