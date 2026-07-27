<x-guest-layout>
    <div class="min-h-[calc(100vh-140px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <x-card class="max-w-lg w-full p-8 shadow-xl border-t-4 border-t-primary">
            <div>
                <h2 class="text-center text-3xl font-heading font-extrabold text-gray-900">
                    Daftar Tenant Baru
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-medium text-primary hover:text-blue-500 transition">
                        Masuk di sini
                    </a>
                </p>
            </div>
            
            @if ($errors->any())
                <div class="mt-4 bg-red-50 text-danger p-4 rounded-lg text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                
                <div class="space-y-4">
                    <div>
                        <x-label for="laundry_name">Nama Laundry</x-label>
                        <x-input id="laundry_name" name="laundry_name" type="text" required placeholder="Cemerlang Laundry" value="{{ old('laundry_name') }}" />
                    </div>
                    
                    <div>
                        <x-label for="name">Nama Pemilik (Owner)</x-label>
                        <x-input id="name" name="name" type="text" required placeholder="Budi Santoso" value="{{ old('name') }}" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-label for="email">Email</x-label>
                            <x-input id="email" name="email" type="email" required placeholder="budi@example.com" value="{{ old('email') }}" />
                        </div>
                        <div>
                            <x-label for="phone">No Handphone</x-label>
                            <x-input id="phone" name="phone" type="text" required placeholder="081234567890" value="{{ old('phone') }}" />
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-label for="password">Password</x-label>
                            <x-input id="password" name="password" type="password" required placeholder="••••••••" />
                        </div>
                        <div>
                            <x-label for="password_confirmation">Konfirmasi Password</x-label>
                            <x-input id="password_confirmation" name="password_confirmation" type="password" required placeholder="••••••••" />
                        </div>
                    </div>
                </div>

                <div>
                    <x-button type="submit" variant="primary" full class="py-3">
                        Daftar & Mulai 14 Hari Trial
                    </x-button>
                </div>
                
                <p class="text-xs text-center text-gray-500 mt-4">
                    Dengan mendaftar, Anda menyetujui Syarat Ketentuan dan Kebijakan Privasi Zoneline.
                </p>
            </form>
        </x-card>
    </div>
</x-guest-layout>
