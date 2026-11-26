<?php

namespace Database\Factories;

use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Program> */
class ProgramFactory extends Factory
{
    protected $model = Program::class;

    public function definition(): array
    {
        $name = fake()->unique()->company().' Program';

        return [
            'name' => $name,
            'slug' => str($name)->slug(),
            'overview' => fake()->sentence(),
            'laboratory_description' => fake()->sentence(),
            'image_paths' => [],
            'image_alts' => [],
            'is_published' => true,
        ];
    }
}
