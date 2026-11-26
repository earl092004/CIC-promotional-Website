<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdmissionsController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\SeoController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::view('/mission-vision', 'mission-vision.index')->name('mission-vision.index');
Route::get('/admissions', [AdmissionsController::class, 'index'])->name('admissions.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::middleware('auth')->get('/articles/{article:slug}/preview', [ArticleController::class, 'preview'])->name('articles.preview');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/programs', [ProgramsController::class, 'index'])->name('programs.index');
Route::get('/programs/{program:slug}', [ProgramsController::class, 'show'])->name('programs.show');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('seo.robots');
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('seo.sitemap');
Route::get('/media/{path}', [MediaController::class, 'show'])->where('path', '.*')->name('media.show');
