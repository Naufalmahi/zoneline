<x-app-layout>
    <x-slot name="title">Tambah Pelanggan Baru</x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('owner.customers.index') }}" class="text-gray-500 hover:text-primary text-sm font-medium flex items-center gap-1">
                &larr; Kembali ke Daftar Pelanggan
            </a>
        </div>

        <x-card>
            <h1 class="text-xl font-bold font-heading text-gray-900 mb-6">Tambah Pelanggan</h1>
            
            <form action="{{ route('owner.customers.store') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <x-label for="name">Nama Lengkap <span class="text-danger">*</span></x-label>
                    <x-input id="name" name="name" type="text" value="{{ old('name') }}" required placeholder="Contoh: Budi Santoso" />
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <x-label for="phone">Nomor HP</x-label>
                    <x-input id="phone" name="phone" type="tel" value="{{ old('phone') }}" placeholder="Contoh: 08123456789" />
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <x-label for="email">Email</x-label>
                    <x-input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Contoh: budi@email.com" />
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <x-label for="notes">Catatan Khusus</x-label>
                    <textarea id="notes" name="notes" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 text-sm py-2 px-3">{{ old('notes') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Contoh: Alergi deterjen tertentu, suka pewangi melati.</p>
                    @error('notes') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('owner.customers.index') }}" class="px-5 py-2 rounded-lg text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 transition">Batal</a>
                    <x-button type="submit" variant="primary">Simpan Pelanggan</x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
