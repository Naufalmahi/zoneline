<x-app-layout>
    <x-slot name="title">Pengaturan Tema & Website</x-slot>

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold font-heading text-gray-900">Pengaturan Tema & Website</h1>
        <p class="text-gray-500 text-sm mt-1">Sesuaikan warna, font, kontak, dan logo untuk dashboard dan website pelanggan Anda.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            Ada beberapa kesalahan, silakan periksa kembali form di bawah.
        </div>
    @endif

    <!-- Main Content with AlpineJS -->
    <div x-data="settingsForm()" class="flex flex-col lg:flex-row gap-8">
        
        <!-- Left Side: Tabs & Form (60%) -->
        <div class="w-full lg:w-3/5">
            <x-card class="p-0 overflow-hidden">
                <form action="{{ route('owner.settings.update') }}" method="POST" enctype="multipart/form-data" id="settings-form">
                    @csrf
                    @method('PUT')

                    <!-- Tabs Navigation -->
                    <div class="flex overflow-x-auto border-b border-gray-200 bg-gray-50">
                        <button type="button" @click="tab = 'identitas'" :class="{'border-primary text-primary bg-white': tab === 'identitas', 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-100': tab !== 'identitas'}" class="px-5 py-4 border-b-2 font-medium text-sm transition whitespace-nowrap">
                            Identitas
                        </button>
                        <button type="button" @click="tab = 'tema'" :class="{'border-primary text-primary bg-white': tab === 'tema', 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-100': tab !== 'tema'}" class="px-5 py-4 border-b-2 font-medium text-sm transition whitespace-nowrap">
                            Tema & Warna
                        </button>
                        <button type="button" @click="tab = 'kontak'" :class="{'border-primary text-primary bg-white': tab === 'kontak', 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-100': tab !== 'kontak'}" class="px-5 py-4 border-b-2 font-medium text-sm transition whitespace-nowrap">
                            Informasi Kontak
                        </button>
                    </div>

                    <!-- Tab Content -->
                    <div class="p-6">
                        
                        <!-- TAB: IDENTITAS -->
                        <div x-show="tab === 'identitas'" x-transition class="space-y-5">
                            <div>
                                <x-label for="business_name">Nama Bisnis</x-label>
                                <x-input id="business_name" name="business_name" type="text" x-model="preview.business_name" placeholder="Contoh: Rainbow Laundry" />
                            </div>
                            
                            <div>
                                <x-label for="tagline">Tagline Singkat</x-label>
                                <x-input id="tagline" name="tagline" type="text" x-model="preview.tagline" placeholder="Contoh: Bersih, Wangi, dan Cepat" />
                                <p class="text-xs text-gray-500 mt-1">Slogan atau moto singkat bisnis Anda.</p>
                            </div>

                            <div>
                                <x-label for="logo">Logo Bisnis</x-label>
                                <div class="flex items-center gap-4 mt-2">
                                    <div class="w-16 h-16 rounded-xl border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden bg-gray-50">
                                        @if(isset($settings->logo))
                                            @php
                                                $logoPath = str_starts_with($settings->logo, 'uploads/') 
                                                    ? asset($settings->logo) 
                                                    : asset('storage/' . $settings->logo);
                                            @endphp
                                            <img src="{{ $logoPath }}" alt="Logo" class="w-full h-full object-contain" id="current-logo">
                                        @else
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" name="logo" id="logo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-primary hover:file:bg-blue-100 transition" @change="previewImage">
                                        <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG. Maksimal 2MB.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB: TEMA -->
                        <div x-show="tab === 'tema'" x-transition x-cloak class="space-y-5">
                            <div>
                                <x-label>Warna Utama (Theme Color)</x-label>
                                <div class="flex items-center gap-3 mt-2">
                                    <input type="color" name="primary_color" id="primary_color" x-model="preview.primary_color" class="w-12 h-12 p-1 rounded border-gray-300 cursor-pointer">
                                    <x-input type="text" x-model="preview.primary_color" class="w-32 uppercase font-mono" />
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Warna ini akan digunakan untuk tombol, menu, dan aksen website.</p>
                                
                                <!-- Preset Colors -->
                                <div class="mt-4 flex gap-2 flex-wrap">
                                    <button type="button" @click="preview.primary_color = '#2563EB'" class="w-8 h-8 rounded-full bg-[#2563EB] ring-2 ring-offset-2 ring-transparent focus:ring-gray-400"></button>
                                    <button type="button" @click="preview.primary_color = '#10B981'" class="w-8 h-8 rounded-full bg-[#10B981] ring-2 ring-offset-2 ring-transparent focus:ring-gray-400"></button>
                                    <button type="button" @click="preview.primary_color = '#8B5CF6'" class="w-8 h-8 rounded-full bg-[#8B5CF6] ring-2 ring-offset-2 ring-transparent focus:ring-gray-400"></button>
                                    <button type="button" @click="preview.primary_color = '#F59E0B'" class="w-8 h-8 rounded-full bg-[#F59E0B] ring-2 ring-offset-2 ring-transparent focus:ring-gray-400"></button>
                                    <button type="button" @click="preview.primary_color = '#1F2937'" class="w-8 h-8 rounded-full bg-[#1F2937] ring-2 ring-offset-2 ring-transparent focus:ring-gray-400"></button>
                                </div>
                            </div>

                            <hr class="border-gray-100">

                            <div>
                                <x-label for="font_family">Gaya Huruf (Font)</x-label>
                                <select name="font_family" id="font_family" x-model="preview.font_family" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
                                    <option value="Inter">Inter (Modern & Bersih)</option>
                                    <option value="Poppins">Poppins (Bulat & Ramah)</option>
                                    <option value="Outfit">Outfit (Sleek & Tech)</option>
                                    <option value="Plus Jakarta Sans">Plus Jakarta Sans (Profesional)</option>
                                    <option value="Playfair Display">Playfair Display (Elegan / Serif)</option>
                                    <option value="Caveat">Caveat (Estetik / Tulisan Tangan)</option>
                                </select>
                            </div>
                        </div>

                        <!-- TAB: KONTAK -->
                        <div x-show="tab === 'kontak'" x-transition x-cloak class="space-y-5">
                            <div>
                                <x-label for="whatsapp_number">Nomor WhatsApp</x-label>
                                <x-input id="whatsapp_number" name="whatsapp_number" type="text" x-model="preview.whatsapp_number" placeholder="Contoh: 081234567890" />
                            </div>

                            <div>
                                <x-label class="inline-flex items-center gap-2 cursor-pointer mt-2">
                                    <input type="checkbox" name="show_whatsapp_button" value="1" x-model="preview.show_whatsapp_button" class="rounded border-gray-300 text-primary focus:ring-primary">
                                    <span class="text-sm text-gray-700">Tampilkan tombol WhatsApp mengambang di website</span>
                                </x-label>
                            </div>

                            <hr class="border-gray-100">

                            <div>
                                <x-label for="address">Alamat Bisnis</x-label>
                                <textarea name="address" id="address" rows="3" x-model="preview.address" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" placeholder="Jl. Contoh No. 123..."></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                        <x-button type="submit" variant="primary" class="shadow-lg">
                            Simpan Pengaturan
                        </x-button>
                    </div>
                </form>
            </x-card>
        </div>

        <!-- Right Side: Live Preview (40%) -->
        <div class="w-full lg:w-2/5">
            <div class="sticky top-6">
                <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Live Preview
                </h3>

                <!-- Preview Window -->
                <div class="bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden" :style="'font-family: ' + getFontFamily(preview.font_family)">
                    
                    <!-- Browser Chrome -->
                    <div class="bg-gray-100 px-4 py-2 border-b border-gray-200 flex items-center gap-2">
                        <div class="flex gap-1.5">
                            <div class="w-3 h-3 rounded-full bg-red-400"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                            <div class="w-3 h-3 rounded-full bg-green-400"></div>
                        </div>
                        <div class="mx-auto bg-white rounded-md px-3 py-1 text-[10px] text-gray-400 w-1/2 text-center border border-gray-200">
                            zoneline.id/{{ auth()->user()->tenant->slug }}
                        </div>
                    </div>

                    <!-- Preview Content -->
                    <div class="p-6 relative min-h-[400px]">
                        
                        <!-- Header Preview -->
                        <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded bg-gray-100 flex items-center justify-center overflow-hidden">
                                    <template x-if="logoPreviewUrl">
                                        <img :src="logoPreviewUrl" class="w-full h-full object-cover">
                                    </template>
                                    <template x-if="!logoPreviewUrl">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586..."></path></svg>
                                    </template>
                                </div>
                                <span class="font-bold text-gray-900" x-text="preview.business_name || 'Nama Bisnis'"></span>
                            </div>
                            <div class="hidden sm:flex gap-4 text-xs font-medium text-gray-500">
                                <span>Home</span>
                                <span>Layanan</span>
                                <span>Kontak</span>
                            </div>
                        </div>

                        <!-- Hero Preview -->
                        <div class="text-center py-6">
                            <h2 class="text-2xl sm:text-3xl font-black text-gray-900 mb-2 leading-tight" x-text="preview.business_name || 'Nama Bisnis'"></h2>
                            <p class="text-gray-500 text-sm mb-6" x-text="preview.tagline || 'Tagline bisnis Anda akan muncul di sini.'"></p>
                            
                            <!-- Theme Colored Button Preview -->
                            <button :style="'background-color: ' + preview.primary_color" class="text-white px-6 py-2.5 rounded-full text-sm font-semibold shadow-lg hover:opacity-90 transition">
                                Lacak Pesanan
                            </button>
                        </div>

                        <!-- Feature Boxes Preview -->
                        <div class="grid grid-cols-2 gap-4 mt-8">
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 text-center">
                                <div :style="'color: ' + preview.primary_color" class="w-8 h-8 mx-auto bg-white rounded-full flex items-center justify-center shadow-sm mb-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <p class="text-xs font-semibold text-gray-700">Cepat</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 text-center">
                                <div :style="'color: ' + preview.primary_color" class="w-8 h-8 mx-auto bg-white rounded-full flex items-center justify-center shadow-sm mb-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <p class="text-xs font-semibold text-gray-700">Bersih</p>
                            </div>
                        </div>

                        <!-- Floating WA Button Preview -->
                        <div x-show="preview.show_whatsapp_button" x-transition class="absolute bottom-6 right-6">
                            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white shadow-lg shadow-green-500/30">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </div>
                        </div>

                    </div>
                </div>
                
                <p class="text-xs text-center text-gray-400 mt-4">Perubahan ini hanya preview. Jangan lupa tekan Simpan.</p>
            </div>
        </div>

    </div>

    <!-- Google Fonts injector for preview (to load Caveat, Playfair, etc dynamically) -->
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&family=Playfair+Display:wght@400;700&family=Plus+Jakarta+Sans:wght@400;600;700&family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('settingsForm', () => ({
                tab: 'identitas',
                logoPreviewUrl: '{{ isset($settings->logo) ? (str_starts_with($settings->logo, 'uploads/') ? asset($settings->logo) : asset('storage/' . $settings->logo)) : '' }}',
                preview: {
                    business_name: '{{ old('business_name', $settings->business_name ?? '') }}',
                    tagline: '{{ old('tagline', $settings->tagline ?? '') }}',
                    primary_color: '{{ old('primary_color', $settings->primary_color ?? '#2563EB') }}',
                    font_family: '{{ old('font_family', $settings->font_family ?? 'Inter') }}',
                    whatsapp_number: '{{ old('whatsapp_number', $settings->whatsapp_number ?? '') }}',
                    address: `{{ old('address', $settings->address ?? '') }}`,
                    show_whatsapp_button: {{ old('show_whatsapp_button', $settings->show_whatsapp_button ?? 1) ? 'true' : 'false' }},
                },
                
                previewImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.logoPreviewUrl = URL.createObjectURL(file);
                    }
                },
                
                getFontFamily(fontName) {
                    // Mapping standard string to CSS font-family
                    if (fontName === 'Caveat') return "'Caveat', cursive";
                    if (fontName === 'Playfair Display') return "'Playfair Display', serif";
                    return `'${fontName}', sans-serif`;
                }
            }))
        })
    </script>
</x-app-layout>
