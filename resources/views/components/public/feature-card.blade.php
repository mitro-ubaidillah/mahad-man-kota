@props(['title', 'description'])

<article class="feature-card">
    <div class="feature-card__icon">
        {{ $icon ?? '✦' }}
    </div>
    <h3>{{ $title }}</h3>
    <p>{{ $description }}</p>
</article>
