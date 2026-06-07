@props([
    'padding' => 'p-6',
    'border' => true,
    'shadow' => 'shadow-[0_18px_45px_rgba(16,36,24,0.07)]',
    'rounded' => 'rounded-3xl',
    'bg' => 'bg-white/95',
])

@php
    $borderClass = $border ? 'border border-emerald-900/10' : '';
    $baseClass = trim("{$bg} {$rounded} {$shadow} {$borderClass} {$padding}");
    $extra = $attributes->get('class');
    $classList = trim($baseClass . ' ' . ($extra ?? ''));
@endphp

<div {{ $attributes->merge(['class' => $classList]) }}>
    {{ $slot }}
</div>
