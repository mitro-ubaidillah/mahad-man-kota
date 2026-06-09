<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sourceImage = public_path('images/banner.png');
        $galleryPath = 'articles/gallery/contoh-galeri-mahad.png';

        if (File::exists($sourceImage) && ! Storage::disk('public')->exists($galleryPath)) {
            Storage::disk('public')->put($galleryPath, File::get($sourceImage));
        }

        $items = [
            'Halaqah Al-Qur’an',
            'Kajian Adab Santri',
            'Pendampingan Belajar',
            'Kegiatan Kebersihan',
            'Muhadharah Santri',
            'Suasana Asrama',
        ];

        foreach ($items as $title) {
            Article::updateOrCreate(
                [
                    'slug' => Str::slug($title),
                    'category' => Article::CATEGORY_GALLERY,
                ],
                [
                    'title' => $title,
                    'excerpt' => $title,
                    'content' => '<p>' . e($title) . '</p>',
                    'thumbnail' => $galleryPath,
                    'status' => 'published',
                    'published_at' => now(),
                ]
            );
        }
    }
}
