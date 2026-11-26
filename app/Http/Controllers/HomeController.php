<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\MediaAsset;
use App\Models\Program;
use App\Support\CicImageCatalog;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $announcements = Article::query()
            ->activeFeatured()
            ->latest('published_at')
            ->limit(3)
            ->get();

        $articles = Article::query()
            ->publiclyVisible()
            ->whereNotIn('id', $announcements->modelKeys())
            ->with('author')
            ->latest('published_at')
            ->limit(3)
            ->get();

        $gallery = MediaAsset::query()
            ->where('is_gallery_item', true)
            ->latest()
            ->limit(6)
            ->get();
        $programs = Program::query()->where('is_published', true)->orderBy('name')->get();

        $stories = $announcements->concat($articles);
        $campusGallery = array_slice(CicImageCatalog::all(), 0, 6);

        return view('welcome', compact('announcements', 'articles', 'gallery', 'campusGallery', 'programs', 'stories'));
    }
}
