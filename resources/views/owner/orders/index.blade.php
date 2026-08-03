<x-app-layout>
    <x-slot name="title">Semua Order</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold font-heading text-gray-900">Daftar Order</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola semua order masuk.</p>
        </div>
        <a href="{{ route('owner.orders.create') }}"
           class="inline-flex items-center gap-2 bg-primary text-white px-4 py-2 rounded-lg font-medium hover:opacity-90 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Buat Order
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">{{ session('success') }}</div>
    @endif

    <x-card>
        <div class="overflow-x-auto -mx-6 -my-6">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3">Invoice</th>
                        <th class="px-6 py-3">Pelanggan</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Pembayaran</th>
                        <th class="px-6 py-3">Total</th>
                        <th class="px-6 py-3">Diterima</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $order->invoice_number }}</td>
                            <td class="px-6 py-4">{{ $order->customer->name ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if($order->status)
                                    <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold"
                                          style="background-color: {{ $order->status->color_hex }}22; color: {{ $order->status->color_hex }}">
                                        {{ $order->status->name }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold {{ $order->payment_status === 'Paid' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                                    {{ $order->payment_status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $order->received_at ? $order->received_at->format('d/m/Y H:i') : '-' }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('owner.orders.show', $order->id) }}"
                                   class="text-primary hover:underline font-medium text-sm">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                                Belum ada order. <a href="{{ route('owner.orders.create') }}" class="text-primary hover:underline">Buat order pertama</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
            <div class="px-6 py-4 border-t">{{ $orders->links() }}</div>
        @endif
    </x-card>
</x-app-layout>
