<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;

class EnseignantControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['id_role' => 1]);
    }

    /** @test */
    public function it_can_list_enseignants()
    {
        User::factory()->count(3)->create(['id_role' => 2]);

        $response = $this->actingAs($this->admin)->get(route('enseignants.index'));

        $response->assertStatus(200);
        $response->assertViewHas('enseignants');
    }

    /** @test */
    public function it_can_create_enseignant()
    {
        $data = [
            'name' => 'Test Enseignant',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->actingAs($this->admin)->post(route('enseignants.store'), $data);

        $response->assertRedirect(route('enseignants.index'));
        $this->assertDatabaseHas('users', ['email' => 'test@example.com', 'id_role' => 2]);
    }

    /** @test */
    public function it_can_update_enseignant()
    {
        $enseignant = User::factory()->create(['id_role' => 2]);

        $data = [
            'name' => 'Updated Enseignant',
            'email' => 'updated@example.com',
        ];

        $response = $this->actingAs($this->admin)->put(route('enseignants.update', $enseignant->id), $data);

        $response->assertRedirect(route('enseignants.index'));
        $this->assertDatabaseHas('users', ['id' => $enseignant->id, 'name' => 'Updated Enseignant']);
    }

    /** @test */
    public function it_can_destroy_enseignant()
    {
        $enseignant = User::factory()->create(['id_role' => 2]);

        $response = $this->actingAs($this->admin)->delete(route('enseignants.destroy', $enseignant->id));

        $response->assertRedirect(route('enseignants.index'));
        $this->assertDatabaseMissing('users', ['id' => $enseignant->id]);
    }

    /** @test */
    public function non_admin_cannot_access_enseignants_index()
    {
        $user = User::factory()->create(['id_role' => 2]);

        $response = $this->actingAs($user)->get(route('enseignants.index'));

        $response->assertStatus(403);
    }
}