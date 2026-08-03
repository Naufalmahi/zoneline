<x-app-layout>
    <x-slot:title>Manajemen Role</x-slot:title>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold font-heading text-gray-900">Daftar Role</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola hak akses dan peran karyawan di bisnis Anda.</p>
        </div>
        <a href="{{ route('owner.roles.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
            + Tambah Role
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 text-green-700 p-4 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 bg-red-50 text-red-700 p-4 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <x-card>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 text-gray-900 uppercase">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Nama Role</th>
                        <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($roles as $role)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                            </td>
                            <td class="px-6 py-4 text-right flex justify-end gap-3">
                                <a href="{{ route('owner.roles.edit', $role->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                                <form action="{{ route('owner.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus role ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-center text-gray-500">Belum ada role tambahan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
</x-app-layout>
