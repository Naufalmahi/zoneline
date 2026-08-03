<x-app-layout>
    <x-slot name="title">Daftar Tenant</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold font-heading text-gray-900">Daftar Tenant (Bisnis)</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola seluruh bisnis yang terdaftar di platform Zoneline.</p>
        </div>
        <a href="{{ route('superadmin.tenants.create') }}"
           class="inline-flex items-center gap-2 bg-primary text-white px-4 py-2 rounded-lg font-medium hover:opacity-90 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Tenant
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
                        <th class="px-6 py-3">Nama Bisnis</th>
                        <th class="px-6 py-3">Subdomain</th>
                        <th class="px-6 py-3">Niche</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Bergabung Sejak</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($tenants as $tenant)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $tenant->settings->business_name ?? $tenant->name }}</td>
                            <td class="px-6 py-4 text-primary"><a href="http://{{ $tenant->slug }}.localhost" target="_blank">{{ $tenant->slug }}.localhost</a></td>
                            <td class="px-6 py-4 capitalize">{{ $tenant->niche }}</td>
                            <td class="px-6 py-4">
                                @if($tenant->status === 'Active')
                                    <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-green-100 text-green-700">{{ $tenant->status }}</span>
                                @elseif($tenant->status === 'Trial')
                                    <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-orange-100 text-orange-700">{{ $tenant->status }}</span>
                                @else
                                    <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-red-100 text-red-700">{{ $tenant->status }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $tenant->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 flex gap-3">
                                <a href="#" class="text-gray-500 hover:underline font-medium">Edit</a>
                                <form action="#" method="POST" onsubmit="return confirm('Suspend tenant ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline font-medium">Suspend</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-400">
                                Belum ada data tenant terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($tenants->hasPages())
            <div class="px-6 py-4 border-t">{{ $tenants->links() }}</div>
        @endif
    </x-card>
</x-app-layout>
