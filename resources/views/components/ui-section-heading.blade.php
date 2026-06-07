@props([
    'badge' => null,
    'description' => null,
])

<div class="flex items-center justify-between gap-4">
    <div>
        <p class="text-lg font-black text-[#102418]">{{ $slot }}</p>
        @if($description)
            <p class="text-xs text-gray-500 mt-0.5">{{ $description }}</p>
        @endif
    </div>
    @if($badge)
        <span class="inline-flex items-center rounded-full bg-amber-100/70 px-3 py-1 text-xs font-black text-amber-700 uppercase tracking-wide">{{ $badge }}</span>
    @endif
</div>
