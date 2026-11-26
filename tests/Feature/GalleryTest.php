<?php

namespace Tests\Feature;

use App\Models\MediaAsset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GalleryTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_gallery_shows_visible_assets_only(): void
    {
        $visible = MediaAsset::factory()->create([
            'title' => 'Approved campus photo',
            'is_gallery_item' => true,
        ]);
        MediaAsset::factory()->create([
            'title' => 'Private media asset',
            'is_gallery_item' => false,
        ]);

        $this->get(route('gallery.index'))
            ->assertOk()
            ->assertViewIs('gallery.index')
            ->assertSee($visible->title)
            ->assertDontSee('Private media asset');
    }

    public function test_public_gallery_has_an_empty_state(): void
    {
        $this->get(route('gallery.index'))
            ->assertOk()
            ->assertSee('The campus gallery is being prepared.');
    }

    public function test_public_gallery_includes_accessible_lightbox_triggers(): void
    {
        $asset = MediaAsset::factory()->create([
            'is_gallery_item' => true,
            'file_path' => 'gallery/campus.png',
            'alt_text' => 'Campus courtyard',
        ]);

        $this->get(route('gallery.index'))
            ->assertOk()
            ->assertSee('data-lightbox-trigger', false)
            ->assertSee('Open image preview')
            ->assertSee(route('media.show', ['path' => $asset->file_path]), false)
            ->assertSee('data-lightbox-modal', false)
            ->assertSee('aria-current="page"', false)
            ->assertSee('sticky top-0', false);
    }
}
