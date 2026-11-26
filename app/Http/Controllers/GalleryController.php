<?php

namespace App\Http\Controllers;

use App\Models\MediaAsset;
use App\Support\CicImageCatalog;
use Illuminate\Contracts\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $assets = MediaAsset::query()
            ->where('is_gallery_item', true)
            ->latest()
            ->paginate(12);
        $campusImages = CicImageCatalog::all();

        return view('gallery.index', compact('assets', 'campusImages'));
    }
}
