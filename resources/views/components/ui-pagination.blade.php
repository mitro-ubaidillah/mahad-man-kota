@props(['paginator'])

@if ($paginator)
    @php
        $current = $paginator->currentPage();
        $last = $paginator->lastPage();
        if ($last <= 1) {
            $pageNumbers = [1];
        } else {
            $startPage = max(1, min($current, $last - 1));
            $pageNumbers = [$startPage, min($last, $startPage + 1)];
        }
    @endphp

    <div class="px-6 py-4 bg-white border-t border-gray-100 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between text-sm text-gray-500">
        <div>
            Menampilkan {{ $paginator->firstItem() ?: 0 }} - {{ $paginator->lastItem() ?: 0 }} dari {{ $paginator->total() }}
        </div>
        <div class="flex items-center gap-2">
            @if ($paginator->onFirstPage())
                <span class="px-3 py-1 rounded-lg text-sm font-semibold text-gray-400 bg-gray-100">Sebelumnya</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 rounded-lg text-sm font-semibold text-gray-700 bg-white border border-gray-200 hover:bg-emerald-50 transition-colors">Sebelumnya</a>
            @endif

            @foreach($pageNumbers as $page)
                <a href="{{ $paginator->url($page) }}"
                   class="px-3 py-1 rounded-lg text-sm font-semibold {{ $page === $current ? 'bg-emerald-500 text-white border border-emerald-500 shadow' : 'text-gray-600 bg-white border border-gray-200 hover:bg-emerald-50' }}">
                    {{ $page }}
                </a>
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 rounded-lg text-sm font-semibold text-gray-700 bg-white border border-gray-200 hover:bg-emerald-50 transition-colors">Berikutnya</a>
            @else
                <span class="px-3 py-1 rounded-lg text-sm font-semibold text-gray-400 bg-gray-100">Berikutnya</span>
            @endif
        </div>
    </div>
@endif
