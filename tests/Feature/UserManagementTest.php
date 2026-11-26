<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_administrators_can_manage_users(): void
    {
        $administrator = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);
        $contributor = User::factory()->create(['role' => User::ROLE_CONTRIBUTOR]);

        $this->assertTrue($administrator->can('viewAny', User::class));
        $this->assertTrue($administrator->can('create', User::class));
        $this->assertFalse($contributor->can('viewAny', User::class));
        $this->assertFalse($contributor->can('create', User::class));
    }

    public function test_administrator_cannot_delete_their_own_account(): void
    {
        $administrator = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);

        $this->assertFalse($administrator->can('delete', $administrator));
    }

    public function test_administrator_dashboard_renders_the_cic_workflow_widgets(): void
    {
        $administrator = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);

        $this->actingAs($administrator)
            ->get('/admin')
            ->assertOk()
            ->assertSee('City of Ilagan College')
            ->assertSee('Educatio Eximia Ad Progressum');
    }
}
