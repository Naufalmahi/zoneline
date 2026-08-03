<x-app-layout>
    <x-slot:title>Tambah Role Baru</x-slot:title>

    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('owner.roles.index') }}" class="text-gray-500 hover:text-primary transition flex items-center text-sm font-medium mb-4">
                &larr; Kembali
            </a>
            <h1 class="text-2xl font-bold font-heading text-gray-900">Tambah Role</h1>
        </div>

        <x-card class="p-6">
            <form action="{{ route('owner.roles.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <x-label for="name">Nama Role</x-label>
                    <x-input id="name" name="name" type="text" placeholder="Misal: Kasir Utama" required value="{{ old('name') }}" />
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4">
                    <x-button type="submit" variant="primary">Simpan Role</x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
