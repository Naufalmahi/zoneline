<x-app-layout>
    <x-slot:title>Edit Role</x-slot:title>

    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('owner.roles.index') }}" class="text-gray-500 hover:text-primary transition flex items-center text-sm font-medium mb-4">
                &larr; Kembali
            </a>
            <h1 class="text-2xl font-bold font-heading text-gray-900">Edit Role</h1>
        </div>

        <x-card class="p-6">
            <form action="{{ route('owner.roles.update', $role->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <x-label for="name">Nama Role</x-label>
                    <x-input id="name" name="name" type="text" required value="{{ old('name', $role->name) }}" />
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4">
                    <x-button type="submit" variant="primary">Update Role</x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
