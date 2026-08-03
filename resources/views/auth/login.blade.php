<x-guest-layout>
    <div class="min-h-[calc(100vh-140px)] flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md mb-4">
            <a href="/" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-primary transition">
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda
            </a>
        </div>
        <x-card class="max-w-md w-full p-8 shadow-xl border-t-4 border-t-primary">
            <div>
                <h2 class="text-center text-3xl font-heading font-extrabold text-gray-900">
                    Masuk ke Akun Anda
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Atau
                    <a href="{{ route('register') }}" class="font-medium text-primary hover:text-blue-500 transition">
                        daftar sebagai tenant baru
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
            
            <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="space-y-4">
                    <div>
                        <x-label for="email">Alamat Email</x-label>
                        <x-input id="email" name="email" type="email" autocomplete="email" required placeholder="owner@laundry.com" value="{{ old('email') }}" />
                    </div>
                    
                    <div>
                        <x-label for="password">Password</x-label>
                        <x-input id="password" name="password" type="password" autocomplete="current-password" required placeholder="••••••••" />
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                            Ingat Saya
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-primary hover:text-blue-500 transition">
                            Lupa password?
                        </a>
                    </div>
                </div>

                <div>
                    <x-button type="submit" variant="primary" full class="py-3">
                        Masuk
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-guest-layout>
