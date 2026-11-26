<?php

namespace Tests\Feature;

use App\Models\MediaAsset;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaAssetTest extends TestCase
{
    use RefreshDatabase;

    public function test_contributors_can_manage_their_assets_but_only_administrators_can_delete_assets(): void
    {
        $contributor = User::factory()->create(['role' => User::ROLE_CONTRIBUTOR]);
        $asset = MediaAsset::factory()->for($contributor, 'uploader')->create();
        $otherAsset = MediaAsset::factory()->create();

        $this->assertTrue($contributor->can('view', $asset));
        $this->assertTrue($contributor->can('update', $asset));
        $this->assertFalse($contributor->can('view', $otherAsset));
        $this->assertFalse($contributor->can('delete', $asset));
    }

    public function test_administrators_can_delete_media_assets(): void
    {
        $administrator = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);
        $asset = MediaAsset::factory()->create();

        $this->assertTrue($administrator->can('delete', $asset));
    }

    public function test_private_media_is_delivered_only_for_public_gallery_assets(): void
    {
        Storage::fake('media');
        Storage::disk('media')->put('gallery/visible.png', 'visible');
        Storage::disk('media')->put('gallery/private.png', 'private');

        MediaAsset::factory()->create([
            'file_path' => 'gallery/visible.png',
            'is_gallery_item' => true,
        ]);
        MediaAsset::factory()->create([
            'file_path' => 'gallery/private.png',
            'is_gallery_item' => false,
        ]);

        $this->get(route('media.show', ['path' => 'gallery/visible.png']))
            ->assertOk()
            ->assertStreamed()
            ->assertStreamedContent('visible')
            ->assertHeader('X-Content-Type-Options', 'nosniff');
        $this->get(route('media.show', ['path' => 'gallery/private.png']))
            ->assertNotFound();
    }

    public function test_authenticated_owner_can_preview_private_media_without_making_it_public(): void
    {
        Storage::fake('media');
        Storage::disk('media')->put('gallery/private.png', 'private');
        $contributor = User::factory()->create(['role' => User::ROLE_CONTRIBUTOR]);
        $asset = MediaAsset::factory()->for($contributor, 'uploader')->create([
            'file_path' => 'gallery/private.png',
            'is_gallery_item' => false,
        ]);

        $this->actingAs($contributor)
            ->get(route('media.show', ['path' => $asset->file_path]))
            ->assertOk();
        Auth::logout();
        $this->get(route('media.show', ['path' => $asset->file_path]))
            ->assertNotFound();
    }

    public function test_private_media_rejects_path_traversal(): void
    {
        $this->get('/media/../.env')->assertNotFound();
    }

    public function test_replacing_or_deleting_a_media_asset_cleans_unreferenced_private_files(): void
    {
        Storage::fake('media');
        Storage::disk('media')->put('gallery/old.png', 'old');
        Storage::disk('media')->put('gallery/new.png', 'new');
        $asset = MediaAsset::factory()->create(['file_path' => 'gallery/old.png']);

        $asset->update(['file_path' => 'gallery/new.png']);
        Storage::disk('media')->assertMissing('gallery/old.png');

        $asset->delete();
        Storage::disk('media')->assertMissing('gallery/new.png');
    }
}
