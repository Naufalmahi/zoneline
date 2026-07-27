<div {{ $attributes->merge(['class' => 'bg-card border border-gray-200 rounded-xl shadow-sm overflow-hidden']) }}>
    @isset($header)
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            {{ $header }}
        </div>
    @endisset

    <div class="p-6">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $footer }}
        </div>
    @endisset
</div>
