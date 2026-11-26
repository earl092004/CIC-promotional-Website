<?php

namespace Tests\Feature;

use App\Models\Program;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProgramTest extends TestCase
{
    use RefreshDatabase;

    public function test_removing_program_images_cleans_unreferenced_private_files(): void
    {
        Storage::fake('media');
        Storage::disk('media')->put('programs/lab.png', 'lab');
        $program = Program::factory()->create([
            'image_paths' => ['programs/lab.png'],
        ]);

        $program->update(['image_paths' => []]);

        Storage::disk('media')->assertMissing('programs/lab.png');
    }

    public function test_public_program_pages_show_published_programs_and_suggestions(): void
    {
        $program = Program::query()->create([
            'name' => 'BS Psychology',
            'slug' => 'bs-psychology-test',
            'overview' => 'Psychology overview.',
            'laboratory_description' => 'Approved facilities preview.',
            'is_published' => true,
        ]);
        Program::query()->create([
            'name' => 'BS Information System',
            'slug' => 'bs-information-system-test',
            'overview' => 'Information systems overview.',
            'laboratory_description' => 'Computer laboratory preview.',
            'is_published' => true,
        ]);

        $this->get(route('programs.show', $program))
            ->assertOk()
            ->assertSee($program->name)
            ->assertSee('BS Information System')
            ->assertSee('Facilities and laboratory preview');
    }

    public function test_program_page_includes_accessible_facility_lightbox_triggers(): void
    {
        $program = Program::factory()->create([
            'slug' => 'lightbox-program',
            'image_paths' => ['programs/lab.png'],
            'image_alts' => ['Computer laboratory'],
        ]);

        $this->get(route('programs.show', $program))
            ->assertOk()
            ->assertSee('data-lightbox-trigger', false)
            ->assertSee('Open image preview')
            ->assertSee('Computer laboratory');
    }

    public function test_only_administrators_can_manage_programs(): void
    {
        $administrator = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);
        $contributor = User::factory()->create(['role' => User::ROLE_CONTRIBUTOR]);
        $program = Program::factory()->create();

        $this->assertTrue($administrator->can('update', $program));
        $this->assertFalse($contributor->can('update', $program));
    }
}
