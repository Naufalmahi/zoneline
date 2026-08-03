<x-app-layout>
    <x-slot name="title">Daftar Layanan</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold font-heading text-gray-900">Data Layanan</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola daftar layanan/produk bisnis Anda.</p>
        </div>
        <a href="{{ route('owner.services.create') }}" class="inline-flex items-center gap-2 bg-primary text-white px-4 py-2 rounded-lg font-medium hover:opacity-90 transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Layanan
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
                        <th class="px-6 py-3">Nama Layanan</th>
                        <th class="px-6 py-3">Kategori</th>
                        <th class="px-6 py-3">Harga Saat Ini</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($services as $service)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $service->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $service->category->name ?? '-' }}</td>
                            <td class="px-6 py-4 font-semibold text-primary">Rp {{ number_format($service->currentPrice->price ?? 0, 0, ',', '.') }} <span class="text-xs text-gray-400 font-normal">/ {{ $service->unit_type }}</span></td>
                            <td class="px-6 py-4">
                                @if($service->is_active)
                                    <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-green-100 text-green-700">Aktif</span>
                                @else
                                    <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-red-100 text-red-700">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex gap-3">
                                <a href="{{ route('owner.services.edit', $service->id) }}" class="text-gray-500 hover:underline font-medium">Edit</a>
                                <form action="{{ route('owner.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline font-medium">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                Belum ada data layanan. <a href="{{ route('owner.services.create') }}" class="text-primary hover:underline">Tambah sekarang</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($services->hasPages())
            <div class="px-6 py-4 border-t">{{ $services->links() }}</div>
        @endif
    </x-card>
</x-app-layout>
