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

    public const NEWS_CATEGORIES = [
        self::CATEGORY_NEWS,
        self::CATEGORY_ACTIVITY,
        self::CATEGORY_ANNOUNCEMENT,
        self::CATEGORY_PPDB,
    ];

    public const ARTICLE_CATEGORIES = [
        self::CATEGORY_EDUCATION,
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

    public function publicUrl(): string
    {
        return in_array($this->category, self::ARTICLE_CATEGORIES, true)
            ? route('public.articles.show', $this->slug)
            : route('public.news.show', $this->slug);
    }
}
