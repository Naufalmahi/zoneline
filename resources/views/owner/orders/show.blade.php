<x-app-layout>
    <x-slot name="title">Detail Order {{ $order->invoice_number }}</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('owner.orders.index') }}" class="text-gray-500 hover:text-primary text-sm font-medium flex items-center gap-1">
            &larr; Kembali ke Daftar Order
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Order Info -->
        <div class="lg:col-span-2 space-y-6">
            <x-card>
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h1 class="text-xl font-bold font-heading text-gray-900">{{ $order->invoice_number }}</h1>
                        <p class="text-sm text-gray-500 mt-1">Diterima: {{ $order->received_at?->format('d M Y, H:i') }}</p>
                    </div>
                    <span class="inline-block px-3 py-1 text-sm rounded-full font-semibold"
                          style="background-color: {{ $order->status->color_hex ?? '#eee' }}22; color: {{ $order->status->color_hex ?? '#888' }}">
                        {{ $order->status->name ?? 'Tidak Diketahui' }}
                    </span>
                </div>

                <!-- Detail Items -->
                <table class="w-full text-sm mt-4">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-2 text-left">Layanan</th>
                            <th class="px-4 py-2 text-right">Qty</th>
                            <th class="px-4 py-2 text-right">Harga/Unit</th>
                            <th class="px-4 py-2 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($order->details as $detail)
                            <tr>
                                <td class="px-4 py-3 font-medium">{{ $detail->service_name }}</td>
                                <td class="px-4 py-3 text-right">{{ $detail->qty }} {{ $detail->unit_type }}</td>
                                <td class="px-4 py-3 text-right">Rp {{ number_format($detail->price_at_that_time, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right font-semibold">Rp {{ number_format($detail->total_price, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="border-t-2 border-gray-200">
                        <tr>
                            <td colspan="3" class="px-4 py-3 text-right font-bold text-gray-900">Total</td>
                            <td class="px-4 py-3 text-right font-bold text-primary text-lg">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </x-card>

            <!-- Update Status -->
            <x-card>
                <h3 class="font-semibold font-heading text-gray-900 mb-4">Update Status Order</h3>
                <form action="{{ route('owner.orders.update-status', $order->id) }}" method="POST" class="flex gap-3 items-end">
                    @csrf
                    @method('PATCH')
                    <div class="flex-1">
                        <x-label for="status_id">Status Baru</x-label>
                        <select name="status_id" id="status_id" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary/20">
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" {{ $order->status_id == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1">
                        <x-label for="notes">Catatan (opsional)</x-label>
                        <x-input name="notes" id="notes" type="text" placeholder="Catatan perubahan status"/>
                    </div>
                    <x-button type="submit" variant="primary">Update</x-button>
                </form>
            </x-card>
        </div>

        <!-- Sidebar: Customer & Log -->
        <div class="space-y-6">
            <x-card>
                <h3 class="font-semibold font-heading text-gray-900 mb-3">Pelanggan</h3>
                <p class="font-medium text-gray-900">{{ $order->customer->name ?? '-' }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $order->customer->phone ?? '-' }}</p>
                <p class="text-sm text-gray-500">{{ $order->customer->member_code ?? '-' }}</p>
            </x-card>

            <x-card>
                <h3 class="font-semibold font-heading text-gray-900 mb-3">Riwayat Status</h3>
                <ul class="space-y-3">
                    @forelse($order->statusLogs->sortByDesc('created_at') as $log)
                        <li class="text-sm">
                            <div class="font-medium text-gray-900">{{ $log->status_name }}</div>
                            <div class="text-gray-500 text-xs">{{ $log->changed_by_name }} &bull; {{ $log->created_at->diffForHumans() }}</div>
                            @if($log->notes)<div class="text-gray-400 italic mt-0.5">{{ $log->notes }}</div>@endif
                        </li>
                    @empty
                        <li class="text-sm text-gray-400">Belum ada riwayat.</li>
                    @endforelse
                </ul>
            </x-card>
        </div>
    </div>
</x-app-layout>
