<?php

namespace Database\Factories;

use App\Models\MediaAsset;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MediaAsset>
 */
class MediaAssetFactory extends Factory
{
    protected $model = MediaAsset::class;

    public function definition(): array
    {
        return [
            'uploaded_by' => User::factory(),
            'file_path' => 'gallery/'.fake()->uuid().'.jpg',
            'title' => fake()->sentence(4),
            'alt_text' => fake()->sentence(8),
            'caption' => fake()->optional()->sentence(),
            'is_gallery_item' => true,
        ];
    }
}
