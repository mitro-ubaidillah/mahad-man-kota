<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\View\View;

class PublicArticleController extends Controller
{
    public function home(): View
    {
        $galleryItems = Article::published()
            ->galleryContent()
            ->oldest('published_at')
            ->take(6)
            ->get();

        $latestNews = Article::published()
            ->where('category', Article::CATEGORY_NEWS)
            ->latest('published_at')
            ->take(3)
            ->get();

        $latestAnnouncements = Article::published()
            ->where('category', Article::CATEGORY_ANNOUNCEMENT)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.home', compact('galleryItems', 'latestNews', 'latestAnnouncements'));
    }

    public function news(): View
    {
        $articles = Article::published()
            ->newsContent()
            ->latest('published_at')
            ->paginate(9);

        return view('pages.news', compact('articles'));
    }

    public function articles(): View
    {
        $articles = Article::published()
            ->articleContent()
            ->latest('published_at')
            ->paginate(9);

        return view('pages.articles', compact('articles'));
    }

    public function gallery(): View
    {
        $galleryItems = Article::published()
            ->galleryContent()
            ->latest('published_at')
            ->paginate(12);

        return view('pages.gallery', compact('galleryItems'));
    }

    public function showNews(string $slug): View
    {
        $article = Article::published()
            ->newsContent()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.article-detail', [
            'article' => $article,
            'backRoute' => route('public.news'),
            'backLabel' => 'Kembali ke Berita',
        ]);
    }

    public function showArticle(string $slug): View
    {
        $article = Article::published()
            ->articleContent()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.article-detail', [
            'article' => $article,
            'backRoute' => route('public.articles'),
            'backLabel' => 'Kembali ke Artikel',
        ]);
    }
}
