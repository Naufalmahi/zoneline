<x-app-layout>
    <x-slot name="title">Pelanggan</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold font-heading text-gray-900">Data Pelanggan</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola daftar pelanggan bisnis Anda.</p>
        </div>
        <a href="{{ route('owner.customers.create') }}"
           class="inline-flex items-center gap-2 bg-primary text-white px-4 py-2 rounded-lg font-medium hover:opacity-90 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Pelanggan
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">{{ session('error') }}</div>
    @endif

    <!-- Search Bar -->
    <form method="GET" class="mb-4">
        <div class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nama, no HP, atau kode member..."
                   class="flex-1 rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-primary focus:ring focus:ring-primary/20">
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium">Cari</button>
        </div>
    </form>

    <x-card>
        <div class="overflow-x-auto -mx-6 -my-6">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3">Kode Member</th>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">No HP</th>
                        <th class="px-6 py-3">Total Order</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($customers as $customer)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-mono text-xs text-gray-500">{{ $customer->member_code }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $customer->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $customer->phone ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $customer->orders_count }}</td>
                            <td class="px-6 py-4 flex gap-3">
                                <a href="{{ route('owner.customers.show', $customer->id) }}" class="text-primary hover:underline font-medium">Detail</a>
                                <a href="{{ route('owner.customers.edit', $customer->id) }}" class="text-gray-500 hover:underline font-medium">Edit</a>
                                <form action="{{ route('owner.customers.destroy', $customer->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus pelanggan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline font-medium">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                Belum ada pelanggan. <a href="{{ route('owner.customers.create') }}" class="text-primary hover:underline">Tambah sekarang</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($customers->hasPages())
            <div class="px-6 py-4 border-t">{{ $customers->links() }}</div>
        @endif
    </x-card>
</x-app-layout>
