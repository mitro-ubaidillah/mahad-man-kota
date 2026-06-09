<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public const CATEGORY_NEWS = 'Berita';
    public const CATEGORY_ACTIVITY = 'Kegiatan';
    public const CATEGORY_ANNOUNCEMENT = 'Pengumuman';
    public const CATEGORY_EDUCATION = 'Artikel Edukasi';
    public const CATEGORY_PPDB = 'PPDB';
    public const CATEGORY_GALLERY = 'Galeri';

    public const CATEGORIES = [
        self::CATEGORY_NEWS,
        self::CATEGORY_ACTIVITY,
        self::CATEGORY_ANNOUNCEMENT,
        self::CATEGORY_EDUCATION,
        self::CATEGORY_PPDB,
        self::CATEGORY_GALLERY,
    ];

    public const NEWS_CATEGORIES = [
        self::CATEGORY_NEWS,
        self::CATEGORY_ACTIVITY,
        self::CATEGORY_ANNOUNCEMENT,
        self::CATEGORY_PPDB,
    ];

    public const ARTICLE_CATEGORIES = [
        self::CATEGORY_EDUCATION,
    ];

    public const GALLERY_CATEGORIES = [
        self::CATEGORY_GALLERY,
    ];

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'thumbnail',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeNewsContent($query)
    {
        return $query->whereIn('category', self::NEWS_CATEGORIES);
    }

    public function scopeArticleContent($query)
    {
        return $query->whereIn('category', self::ARTICLE_CATEGORIES);
    }

    public function scopeGalleryContent($query)
    {
        return $query->whereIn('category', self::GALLERY_CATEGORIES);
    }

    public function publicUrl(): string
    {
        if (in_array($this->category, self::GALLERY_CATEGORIES, true)) {
            return route('public.gallery');
        }

        return in_array($this->category, self::ARTICLE_CATEGORIES, true)
            ? route('public.articles.show', $this->slug)
            : route('public.news.show', $this->slug);
    }
}
