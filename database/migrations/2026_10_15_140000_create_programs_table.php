<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('overview')->nullable();
            $table->text('laboratory_description')->nullable();
            $table->json('image_paths')->nullable();
            $table->json('image_alts')->nullable();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });

        foreach ([
            ['BS Psychology', 'bs-psychology'],
            ['BS Medical Technology', 'bs-medical-technology'],
            ['BS Radiologic Technology', 'bs-radiologic-technology'],
            ['BS Information System', 'bs-information-system'],
        ] as [$name, $slug]) {
            DB::table('programs')->insert([
                'name' => $name,
                'slug' => $slug,
                'overview' => 'Program information and official updates will be managed by CIC.',
                'laboratory_description' => 'Laboratory and campus facilities information will be added here as approved images and descriptions become available.',
                'image_paths' => json_encode([]),
                'image_alts' => json_encode([]),
                'is_published' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
