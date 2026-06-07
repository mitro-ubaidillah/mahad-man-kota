@props([
    'caption' => null,
    'headClass' => 'bg-emerald-50/80',
    'bodyClass' => 'bg-white divide-y divide-emerald-900/10',
])

<div {{ $attributes->merge(['class' => 'overflow-hidden border border-emerald-900/10 rounded-3xl shadow-[0_18px_45px_rgba(16,36,24,0.06)]']) }}>
    @if($caption)
        <div class="px-6 py-3 text-sm font-bold text-emerald-900 bg-emerald-50 border-b border-emerald-900/10">{{ $caption }}</div>
    @endif
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-emerald-900/10">
            <thead class="{{ $headClass }}">
                {{ $head }}
            </thead>
            <tbody class="{{ $bodyClass }}">
                {{ $body }}
            </tbody>
        </table>
    </div>
</div>
