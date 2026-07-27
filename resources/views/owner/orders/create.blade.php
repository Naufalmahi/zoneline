<x-app-layout>
    <x-slot name="title">Tambah Order Baru</x-slot>

    <div class="flex flex-col lg:flex-row gap-6" x-data="orderForm()">
        
        <!-- Left Side: Order Form (Fast Input) -->
        <div class="flex-1">
            <x-card>
                <!-- Tampilkan Error Validasi Global -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-50 text-danger p-4 rounded-lg">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('owner.orders.store') }}" method="POST" id="order-form">
                    @csrf
                    
                    <div class="space-y-6">
                        <!-- Customer Selection -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <x-label for="customer_id">Pelanggan <span class="text-danger">*</span></x-label>
                                <button type="button" class="text-sm text-primary font-medium hover:underline">+ Pelanggan Baru</button>
                            </div>
                            <select name="customer_id" id="customer_id" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 py-2 px-3">
                                <option value="">Pilih Pelanggan...</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }} - {{ $customer->phone ?? 'Tanpa No HP' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Service Selection Grid -->
                        <div>
                            <x-label>Layanan (Service) <span class="text-danger">*</span></x-label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-2">
                                @foreach($services as $index => $service)
                                    <label class="cursor-pointer" @click="selectService({{ $service->id }}, '{{ $service->name }}', {{ $service->currentPrice->price ?? 0 }})">
                                        <input type="radio" name="service_id" class="peer sr-only" value="{{ $service->id }}" 
                                            {{ old('service_id') == $service->id ? 'checked' : ($index == 0 ? 'checked' : '') }}
                                            x-model="selectedServiceId">
                                        <div class="rounded-lg border-2 border-gray-200 p-3 hover:bg-gray-50 peer-checked:border-primary peer-checked:bg-blue-50 text-center transition">
                                            <div class="font-semibold text-gray-900">{{ $service->name }}</div>
                                            <div class="text-xs text-gray-500">Rp {{ number_format($service->currentPrice->price ?? 0, 0, ',', '.') }} / {{ $service->unit_type }}</div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Quantity and Note -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-label for="qty">Berat / Jumlah <span class="text-danger">*</span></x-label>
                                <div class="relative">
                                    <x-input id="qty" name="qty" type="number" step="0.1" placeholder="0" class="text-2xl font-bold py-3" 
                                        x-model="qty" @input="calculateTotal" value="{{ old('qty') }}" required />
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 font-medium text-lg">Kg/Pcs</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <x-label for="notes">Catatan Tambahan</x-label>
                                <x-input id="notes" name="notes" type="text" placeholder="Cth: Jangan digabung warna putih" class="py-3" value="{{ old('notes') }}" />
                            </div>
                        </div>
                    </div>
                </form>
            </x-card>
        </div>

        <!-- Right Side: Order Summary -->
        <div class="w-full lg:w-96">
            <x-card class="sticky top-20 bg-gray-50 border-gray-200">
                <h3 class="font-heading font-semibold text-lg border-b border-gray-200 pb-4 mb-4">Ringkasan Order</h3>
                
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Layanan</span>
                        <span class="font-medium" x-text="serviceName"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Harga per Unit</span>
                        <span class="font-medium" x-text="formatRupiah(servicePrice)"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Jumlah</span>
                        <span class="font-medium" x-text="qty ? qty : 0"></span>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-3 mt-3">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span class="text-primary" x-text="formatRupiah(totalPrice)"></span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 space-y-3">
                    <x-button type="submit" form="order-form" variant="primary" full class="py-4 text-lg shadow-lg">Simpan Order (Enter)</x-button>
                </div>
            </x-card>
        </div>

    </div>

    <!-- Alpine Component Logic -->
    <script>
        function orderForm() {
            // Setup initial values from the first available service if not set
            const services = @json($services);
            let initServiceId = services.length > 0 ? services[0].id : null;
            let initServiceName = services.length > 0 ? services[0].name : '-';
            let initServicePrice = (services.length > 0 && services[0].current_price) ? services[0].current_price.price : 0;
            
            // Check old input
            const oldServiceId = "{{ old('service_id') }}";
            if(oldServiceId) {
                const found = services.find(s => s.id == oldServiceId);
                if(found) {
                    initServiceId = found.id;
                    initServiceName = found.name;
                    initServicePrice = found.current_price ? found.current_price.price : 0;
                }
            }

            return {
                selectedServiceId: initServiceId,
                serviceName: initServiceName,
                servicePrice: initServicePrice,
                qty: "{{ old('qty', '') }}",
                totalPrice: 0,

                init() {
                    this.calculateTotal();
                },

                selectService(id, name, price) {
                    this.selectedServiceId = id;
                    this.serviceName = name;
                    this.servicePrice = price;
                    this.calculateTotal();
                },

                calculateTotal() {
                    const q = parseFloat(this.qty) || 0;
                    this.totalPrice = q * this.servicePrice;
                },

                formatRupiah(angka) {
                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
                }
            }
        }
    </script>
</x-app-layout>
