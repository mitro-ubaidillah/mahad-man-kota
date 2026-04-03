@props(['color' => 'gray', 'size' => 'md'])
@php
$colors = [
    'emerald' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
    'red' => 'bg-red-100 text-red-800 border-red-200',
    'yellow' => 'bg-amber-100 text-amber-800 border-amber-200',
    'blue' => 'bg-blue-100 text-blue-800 border-blue-200',
    'gray' => 'bg-gray-100 text-gray-800 border-gray-200',
];
$baseClasses = 'inline-flex items-center font-semibold rounded-full border px-3 py-1 text-sm';
$colorClass = $colors[$color] ?? $colors['gray'];
@endphp
<span {{ $attributes->merge(['class' => $baseClasses . ' ' . $colorClass]) }}>
    {{ $slot }}
</span>
