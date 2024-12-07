<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleTagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

Route::get('/register', function () {
    return view('auth.register');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [ArticleController::class, 'index'])->name('home');

    // Halaman Tambah Artikel
    Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/article', [ArticleController::class, 'store'])->name('article.store');

    // Halaman Detail Artikel
    Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');

    // Halaman Edit Artikel
    Route::get('/article/{id}/edit', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('/article/{id}', [ArticleController::class, 'update'])->name('article.update');

    // Hapus Artikel
    Route::delete('/article/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');

    Route::get('/tags', [ArticleTagController::class, 'index'])->name('tags.index');
    Route::get('/tag-create', [ArticleTagController::class, 'create'])->name('tags.create');
    Route::post('/tags', [ArticleTagController::class, 'store'])->name('tags.store');
    Route::get('/tag-{id}-edit', [ArticleTagController::class, 'edit'])->name('tags.edit');
    Route::put('/tags/{id}', [ArticleTagController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{id}', [ArticleTagController::class, 'destroy'])->name('tags.destroy');

    Route::get('/kelompok11gacorabiezsemlehoysiuu', [ArticleController::class, 'about'])->name('about');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/cat-create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/cat-{id}-edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});


require __DIR__.'/auth.php';
