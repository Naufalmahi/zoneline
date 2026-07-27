@props(['disabled' => false, 'type' => 'text'])

<input {{ $disabled ? 'disabled' : '' }} type="{{ $type }}" {!! $attributes->merge(['class' => 'w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 focus:ring-opacity-50 transition-shadow duration-200 py-2 px-3 border disabled:bg-gray-100 disabled:cursor-not-allowed']) !!}>
