@props([
    'label',
    'value',
    'accent' => 'emerald',
])

@php
    $textClass = "text-{$accent}-500";
    $bgClass = "bg-{$accent}-50";
@endphp

<x-ui-card {{ $attributes->merge(['class' => 'flex items-center justify-between transition-all hover:-translate-y-1 hover:shadow-[0_22px_55px_rgba(16,36,24,0.10)]']) }}>
    <div>
        <div class="text-sm font-bold text-gray-500 mb-1">{{ $label }}</div>
        <div class="text-3xl font-black text-[#102418]">{{ $value ?? '-' }}</div>
    </div>
    <div class="{{ $textClass }} {{ $bgClass }} p-3 rounded-2xl ring-1 ring-current/10">
        {{ $slot }}
    </div>
</x-ui-card>
