<x-app-layout>
    <x-slot name="title">Tambah Layanan Baru</x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('owner.services.index') }}" class="text-gray-500 hover:text-primary text-sm font-medium flex items-center gap-1">
                &larr; Kembali ke Daftar Layanan
            </a>
        </div>

        <x-card>
            <h1 class="text-xl font-bold font-heading text-gray-900 mb-6">Tambah Layanan Baru</h1>
            
            <form action="{{ route('owner.services.store') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <x-label for="name">Nama Layanan <span class="text-danger">*</span></x-label>
                    <x-input id="name" name="name" type="text" value="{{ old('name') }}" required placeholder="Contoh: Cuci Kering Setrika" />
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-label for="price">Harga Saat Ini <span class="text-danger">*</span></x-label>
                        <div class="flex mt-1">
                            <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">Rp</span>
                            <input id="price" name="price" type="number" min="0" value="{{ old('price') }}" required class="flex-1 rounded-r-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" placeholder="6000">
                        </div>
                        @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <x-label for="unit_type">Satuan Harga <span class="text-danger">*</span></x-label>
                        <select name="unit_type" id="unit_type" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
                            <option value="kg" {{ old('unit_type') == 'kg' ? 'selected' : '' }}>Per Kilogram (kg)</option>
                            <option value="pcs" {{ old('unit_type') == 'pcs' ? 'selected' : '' }}>Per Satuan (pcs)</option>
                            <option value="meter" {{ old('unit_type') == 'meter' ? 'selected' : '' }}>Per Meter (m)</option>
                        </select>
                        @error('unit_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <x-label class="inline-flex items-center gap-2 cursor-pointer mt-2">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary">
                        <span class="text-sm text-gray-700">Layanan Aktif (Bisa dipilih saat order)</span>
                    </x-label>
                </div>
                
                <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('owner.services.index') }}" class="px-5 py-2 rounded-lg text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 transition">Batal</a>
                    <x-button type="submit" variant="primary">Simpan Layanan</x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
