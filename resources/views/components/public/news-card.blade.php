@props(['date', 'title', 'description', 'url' => null, 'thumbnail' => null, 'category' => null])

<article class="news-card">
    <div class="news-card__image" aria-hidden="true">
        @if ($thumbnail)
            <img src="{{ $thumbnail }}" alt="">
        @else
            <span></span>
        @endif
    </div>
    <div class="news-card__body">
        <time>{{ $date }}</time>
        @if ($category)
            <em>{{ $category }}</em>
        @endif
        <h3>{{ $title }}</h3>
        <p>{{ $description }}</p>
        <a href="{{ $url ?? route('public.news') }}">Baca selengkapnya</a>
    </div>
</article>
