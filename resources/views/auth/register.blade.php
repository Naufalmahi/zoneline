<x-guest-layout>
    <div class="min-h-[calc(100vh-140px)] flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-lg mb-4">
            <a href="/" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-primary transition">
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda
            </a>
        </div>
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
                        <x-label class="mb-2">Jenis Bisnis</x-label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="niche" value="laundry" class="peer sr-only" checked>
                                <div class="rounded-lg border border-gray-200 bg-white p-3 hover:bg-gray-50 peer-checked:border-primary peer-checked:bg-blue-50 transition text-center">
                                    <div class="text-2xl mb-1">🧺</div>
                                    <div class="font-medium text-sm text-gray-900">Laundry</div>
                                </div>
                            </label>
                            
                            <label class="cursor-pointer">
                                <input type="radio" name="niche" value="coffee" class="peer sr-only">
                                <div class="rounded-lg border border-gray-200 bg-white p-3 hover:bg-gray-50 peer-checked:border-primary peer-checked:bg-blue-50 transition text-center">
                                    <div class="text-2xl mb-1">☕</div>
                                    <div class="font-medium text-sm text-gray-900">Coffee Shop</div>
                                </div>
                            </label>
                            
                            <label class="cursor-pointer">
                                <input type="radio" name="niche" value="barbershop" class="peer sr-only">
                                <div class="rounded-lg border border-gray-200 bg-white p-3 hover:bg-gray-50 peer-checked:border-primary peer-checked:bg-blue-50 transition text-center">
                                    <div class="text-2xl mb-1">💈</div>
                                    <div class="font-medium text-sm text-gray-900">Barbershop</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div>
                        <x-label for="laundry_name">Nama Bisnis</x-label>
                        <x-input id="laundry_name" name="laundry_name" type="text" required placeholder="Nama Usaha Anda" value="{{ old('laundry_name') }}" />
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
