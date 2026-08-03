<x-app-layout>
    <x-slot name="title">
        Super Admin Dashboard
    </x-slot>

    <!-- Top Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-card class="border-l-4 border-l-primary">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-primary">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="mb-1 text-sm font-medium text-gray-500">Total Tenants</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_tenants'] ?? 0 }}</h3>
                </div>
            </div>
        </x-card>
        
        <x-card class="border-l-4 border-l-success">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-success">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="mb-1 text-sm font-medium text-gray-500">Active Tenants</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $stats['active_tenants'] ?? 0 }}</h3>
                </div>
            </div>
        </x-card>

        <x-card class="border-l-4 border-l-warning">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-orange-100 text-warning">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="mb-1 text-sm font-medium text-gray-500">Trial Tenants</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $stats['trial_tenants'] ?? 0 }}</h3>
                </div>
            </div>
        </x-card>

        <x-card class="border-l-4 border-l-primary">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-primary">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="mb-1 text-sm font-medium text-gray-500">Total Users</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_users'] ?? 0 }}</h3>
                </div>
            </div>
        </x-card>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Recent Tenants (Spans 2 columns) -->
        <div class="lg:col-span-2">
            <x-card>
                <x-slot name="header">
                    <div class="flex justify-between items-center">
                        <h3 class="font-heading font-semibold text-lg">Pendaftar Tenant Baru</h3>
                    </div>
                </x-slot>
                
                <div class="overflow-x-auto -mx-6 -my-6">
                    <x-table>
                        <x-slot name="header">
                            <th scope="col" class="px-6 py-3">Tenant Name</th>
                            <th scope="col" class="px-6 py-3">Subdomain</th>
                            <th scope="col" class="px-6 py-3">Niche</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Joined</th>
                        </x-slot>
                        
                        @forelse($recentTenants ?? [] as $tenant)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $tenant->name }}</td>
                            <td class="px-6 py-4 text-primary">{{ $tenant->slug }}.localhost</td>
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
                            <td class="px-6 py-4">{{ $tenant->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data tenant.</td>
                        </tr>
                        @endforelse
                    </x-table>
                </div>
            </x-card>
        </div>

        <!-- Quick Actions (Spans 1 column) -->
        <div>
            <x-card>
                <x-slot name="header">
                    <h3 class="font-heading font-semibold text-lg">Menu Cepat</h3>
                </x-slot>

                <div class="flex flex-col gap-3">
                    <a href="{{ route('superadmin.tenants.create') }}" class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:border-primary hover:bg-blue-50 transition">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Tambah Tenant</p>
                            <p class="text-xs text-gray-500">Daftarkan manual</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('superadmin.billing.index') }}" class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:border-primary hover:bg-blue-50 transition">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Manajemen Billing</p>
                            <p class="text-xs text-gray-500">Cek invoice langganan</p>
                        </div>
                    </a>
                </div>
            </x-card>
        </div>

    </div>
</x-app-layout>
