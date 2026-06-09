<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicArticleController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\SantriController as AdminSantriController;
use App\Http\Controllers\Admin\KelasController as AdminKelasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PublicArticleController::class, 'home'])->name('home');
Route::view('/profil', 'pages.profile')->name('public.profile');
Route::view('/program', 'pages.programs')->name('public.programs');
Route::view('/kehidupan-mahad', 'pages.life')->name('public.life');
Route::get('/berita', [PublicArticleController::class, 'news'])->name('public.news');
Route::get('/berita/{slug}', [PublicArticleController::class, 'showNews'])->name('public.news.show');
Route::get('/artikel', [PublicArticleController::class, 'articles'])->name('public.articles');
Route::get('/artikel/{slug}', [PublicArticleController::class, 'showArticle'])->name('public.articles.show');
Route::get('/galeri', [PublicArticleController::class, 'gallery'])->name('public.gallery');
Route::view('/kontak', 'pages.contact')->name('public.contact');

use App\Models\Santri;
use App\Models\Activity;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Carbon;

Route::get('/dashboard', function () {
    // Counts
    $santriCount = Santri::count();
    $activityCount = Activity::count();
    $adminCount = User::where('is_admin', true)->count();

    // Weekly attendance (last 7 days) - count of present per day
    $today = Carbon::today();
    $weeklyLabels = [];
    $weeklyData = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = $today->copy()->subDays($i);
        $weeklyLabels[] = $date->format('D');
        $count = Attendance::whereDate('created_at', $date)->where('status', 'present')->count();
        $weeklyData[] = $count;
    }

    // Growth (santri created per month for last 6 months)
    $growthLabels = [];
    $growthData = [];
    for ($m = 5; $m >= 0; $m--) {
        $dt = $today->copy()->subMonths($m);
        $label = $dt->format('M');
        $growthLabels[] = $label;
        $start = $dt->copy()->startOfMonth();
        $end = $dt->copy()->endOfMonth();
        $growthData[] = Santri::whereBetween('created_at', [$start, $end])->count();
    }

    return view('dashboard', compact('santriCount','activityCount','adminCount','weeklyLabels','weeklyData','growthLabels','growthData'));
})->middleware(['auth', 'verified', 'not_article_only'])->name('dashboard');

Route::prefix('admin-mahad')
    ->name('mahad-admin.')
    ->middleware(['auth', 'article_admin'])
    ->group(function () {
        Route::get('/', function () {
            return redirect()->route('mahad-admin.articles.index');
        })->name('dashboard');

        Route::post('articles/trix-attachments', [ArticleController::class, 'uploadAttachment'])
            ->name('articles.trix-attachments.store');

        Route::get('gallery', [ArticleController::class, 'galleryIndex'])->name('gallery.index');
        Route::get('gallery/create', [ArticleController::class, 'galleryCreate'])->name('gallery.create');
        Route::post('gallery', [ArticleController::class, 'galleryStore'])->name('gallery.store');
        Route::get('gallery/{article}/edit', [ArticleController::class, 'galleryEdit'])->name('gallery.edit');
        Route::put('gallery/{article}', [ArticleController::class, 'galleryUpdate'])->name('gallery.update');
        Route::delete('gallery/{article}', [ArticleController::class, 'galleryDestroy'])->name('gallery.destroy');

        Route::resource('articles', ArticleController::class);
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin-only management routes (users, kelas, santris, activities, restricted attendance ops)
Route::middleware(['auth','attendance_admin'])->group(function () {
    // WhatsApp Gateway
    Route::prefix('wa-gateway')->name('admin.wa-')->group(function() {
        // Device
        Route::get('/device', [App\Http\Controllers\Admin\WaDeviceController::class, 'index'])->name('device.index');
        Route::post('/device', [App\Http\Controllers\Admin\WaDeviceController::class, 'store'])->name('device.store');
        Route::get('/device/generate-qr', [App\Http\Controllers\Admin\WaDeviceController::class, 'generateQr'])->name('device.generate-qr');
        Route::get('/device/check-status', [App\Http\Controllers\Admin\WaDeviceController::class, 'checkStatus'])->name('device.check-status');
        Route::post('/device/logout', [App\Http\Controllers\Admin\WaDeviceController::class, 'logout'])->name('device.logout');

        // Template
        Route::resource('/template', App\Http\Controllers\Admin\WhatsappTemplateController::class)->except(['show']);

        // Broadcast
        Route::get('/broadcast', [App\Http\Controllers\Admin\WhatsappBroadcastController::class, 'index'])->name('broadcast.index');
        Route::post('/broadcast', [App\Http\Controllers\Admin\WhatsappBroadcastController::class, 'send'])->name('broadcast.send');
    });
    // User management (except index, which is visible to all authenticated users)
    Route::post('users/check-email', [AdminUserController::class, 'checkEmail'])->name('users.check-email');
    Route::resource('users', AdminUserController::class)->except(['index']);

    // Kelas (class) management for admins (except index)
    // Use "kelas" as the route parameter name to avoid the default singular "kela"
    Route::get('kelas/import-template', [AdminKelasController::class, 'downloadTemplate'])->name('kelas.import-template');
    Route::post('kelas/import', [AdminKelasController::class, 'import'])->name('kelas.import');
    Route::resource('kelas', AdminKelasController::class)
        ->parameters(['kelas' => 'kelas'])
        ->except(['index', 'show']);

    // Santri management (CRUD + import) only for admins (except index)
    Route::get('santris/import-template', [AdminSantriController::class, 'downloadTemplate'])->name('santris.import-template');
    Route::post('santris/import', [AdminSantriController::class, 'import'])->name('santris.import');
    Route::resource('santris', AdminSantriController::class)->except(['index', 'show']);

    // Activity management only for admins (except index)
    Route::resource('activities', App\Http\Controllers\Admin\ActivityController::class)->except(['index', 'show']);

    // Attendance destroy restricted to admins (other ops allowed for all authenticated users)
    Route::delete('attendances/{attendance}', [App\Http\Controllers\Admin\AttendanceController::class, 'destroy'])
        ->name('attendances.destroy');
});

// Attendance usage + read-only listings (for all authenticated users)
Route::middleware(['auth', 'not_article_only'])->group(function () {
    // Read-only index pages for non-admins
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('kelas', [AdminKelasController::class, 'index'])->name('kelas.index');
    Route::get('santris', [AdminSantriController::class, 'index'])->name('santris.index');
    Route::get('activities', [App\Http\Controllers\Admin\ActivityController::class, 'index'])->name('activities.index');

    // Export recap
    Route::get('attendances/export', [App\Http\Controllers\Admin\AttendanceController::class, 'export'])->name('attendances.export');

    // Attendance CRUD except destroy (destroy handled in admin group above)
    Route::resource('attendances', App\Http\Controllers\Admin\AttendanceController::class)
        ->except(['destroy', 'show']);

    // AJAX helper to fetch santris for a kelas
    Route::get('kelas/{kelas}/santris', [App\Http\Controllers\Admin\AttendanceController::class, 'santrisForKelas'])->name('kelas.santris');
    // Class-based attendance: take attendance for an entire kelas
    Route::get('attendances/kelas/{kelas}/create', [App\Http\Controllers\Admin\AttendanceController::class, 'createForKelas'])->name('attendances.createForKelas');
    Route::post('attendances/kelas/{kelas}', [App\Http\Controllers\Admin\AttendanceController::class, 'storeForKelas'])->name('attendances.storeForKelas');
});
