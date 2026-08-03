<x-app-layout>
    <x-slot name="title">Tambah Tenant Baru</x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('superadmin.tenants.index') }}" class="text-gray-500 hover:text-primary text-sm font-medium flex items-center gap-1">
                &larr; Kembali ke Daftar Tenant
            </a>
        </div>

        <x-card>
            <h1 class="text-xl font-bold font-heading text-gray-900 mb-6">Pendaftaran Tenant Baru (Manual)</h1>
            
            <form action="{{ route('superadmin.tenants.store') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <x-label for="name">Nama Bisnis (Sistem) <span class="text-danger">*</span></x-label>
                    <x-input id="name" name="name" type="text" value="{{ old('name') }}" required placeholder="Contoh: Kopi Senja" />
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <x-label for="slug">Subdomain <span class="text-danger">*</span></x-label>
                    <div class="flex mt-1">
                        <input id="slug" name="slug" type="text" value="{{ old('slug') }}" required class="flex-1 rounded-l-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" placeholder="kopisenja">
                        <span class="inline-flex items-center px-3 rounded-r-lg border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                            .localhost
                        </span>
                    </div>
                    @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <x-label for="niche">Jenis Bisnis (Niche) <span class="text-danger">*</span></x-label>
                    <select name="niche" id="niche" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
                        <option value="laundry" {{ old('niche') == 'laundry' ? 'selected' : '' }}>Laundry</option>
                        <option value="coffee" {{ old('niche') == 'coffee' ? 'selected' : '' }}>Coffee Shop</option>
                        <option value="barbershop" {{ old('niche') == 'barbershop' ? 'selected' : '' }}>Barbershop</option>
                    </select>
                    @error('niche') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <x-label for="status">Status Langganan <span class="text-danger">*</span></x-label>
                    <select name="status" id="status" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
                        <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Trial" {{ old('status') == 'Trial' ? 'selected' : '' }}>Trial (Free)</option>
                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive / Suspended</option>
                    </select>
                    @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('superadmin.tenants.index') }}" class="px-5 py-2 rounded-lg text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 transition">Batal</a>
                    <x-button type="submit" variant="primary">Daftarkan Tenant</x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
