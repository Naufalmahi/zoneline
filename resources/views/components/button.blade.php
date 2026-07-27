@props(['type' => 'submit', 'variant' => 'primary', 'full' => false])

@php
$baseClasses = 'inline-flex items-center justify-center px-4 py-2 rounded-lg font-semibold transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

$variants = [
    'primary'   => 'bg-primary text-white hover:bg-blue-700 focus:ring-primary',
    'secondary' => 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-gray-200',
    'danger'    => 'bg-danger text-white hover:bg-red-600 focus:ring-danger',
    'success'   => 'bg-success text-white hover:bg-green-600 focus:ring-success',
];

$classes = $baseClasses . ' ' . $variants[$variant];
if ($full) $classes .= ' w-full';
@endphp

<button {{ $attributes->merge(['type' => $type, 'class' => $classes]) }}>
    {{ $slot }}
</button>
