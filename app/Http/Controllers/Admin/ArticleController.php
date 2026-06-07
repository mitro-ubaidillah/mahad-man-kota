<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'article_admin']);
    }

    public function index(Request $request): View
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $articles = Article::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('title', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%")
                        ->orWhere('excerpt', 'like', "%{$search}%");
                });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $stats = [
            'total' => Article::count(),
            'published' => Article::where('status', 'published')->count(),
            'draft' => Article::where('status', 'draft')->count(),
            'archived' => Article::where('status', 'archived')->count(),
        ];

        return view('admin.articles.index', compact('articles', 'stats', 'search', 'status'));
    }

    public function create(): View
    {
        return view('admin.articles.create', [
            'article' => new Article([
                'status' => 'draft',
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['content'] = $this->sanitizeContent($data['content']);
        $data['slug'] = $this->prepareSlug($data['slug'] ?? null, $data['title']);
        $data = $this->preparePublicationData($data);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        $article = Article::create($data);

        return redirect()
            ->route('mahad-admin.articles.show', $article)
            ->with('success', 'Artikel berhasil dibuat.');
    }

    public function show(Article $article): View
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article): View
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $data = $this->validatedData($request, $article);
        $data['content'] = $this->sanitizeContent($data['content']);
        $data['slug'] = $this->prepareSlug($data['slug'] ?? null, $data['title'], $article);
        $data = $this->preparePublicationData($data);

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }

            $data['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()
            ->route('mahad-admin.articles.show', $article)
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        $article->delete();

        return redirect()
            ->route('mahad-admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }

    public function uploadAttachment(Request $request)
    {
        $data = $request->validate([
            'file' => ['required', 'image', 'max:3072'],
        ]);

        $path = $data['file']->store('articles/content', 'public');
        $url = Storage::url($path);

        return response()->json([
            'url' => $url,
            'href' => $url,
            'location' => $url,
        ]);
    }

    private function validatedData(Request $request, ?Article $article = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => [
                'nullable',
                'string',
                'max:200',
                Rule::unique('articles', 'slug')->ignore($article?->id),
            ],
            'excerpt' => ['nullable', 'string', 'max:280'],
            'content' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:80', Rule::in([
                Article::CATEGORY_NEWS,
                Article::CATEGORY_ACTIVITY,
                Article::CATEGORY_ANNOUNCEMENT,
                Article::CATEGORY_EDUCATION,
                Article::CATEGORY_PPDB,
            ])],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'published_at' => ['nullable', 'date'],
        ]);
    }

    private function prepareSlug(?string $slug, string $title, ?Article $article = null): string
    {
        $baseSlug = Str::slug($slug ?: $title) ?: Str::random(8);
        $candidate = $baseSlug;
        $counter = 2;

        while (
            Article::where('slug', $candidate)
                ->when($article, fn ($query) => $query->where('id', '!=', $article->id))
                ->exists()
        ) {
            $candidate = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $candidate;
    }

    private function preparePublicationData(array $data): array
    {
        if ($data['status'] === 'published') {
            $data['published_at'] = now();
        }

        if ($data['status'] !== 'published') {
            $data['published_at'] = null;
        }

        return $data;
    }

    private function sanitizeContent(string $content): string
    {
        $content = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $content);
        $content = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', '', $content);
        $content = preg_replace('/\son\w+="[^"]*"/i', '', $content);
        $content = preg_replace("/\son\w+='[^']*'/i", '', $content);
        $content = preg_replace('/javascript:/i', '', $content);

        return strip_tags($content, '<div><p><br><strong><b><em><i><u><h1><h2><h3><blockquote><ul><ol><li><a><pre><code><figure><figcaption><img>');
    }
}
