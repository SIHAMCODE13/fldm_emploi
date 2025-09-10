<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(['id_role' => 1]);
    }

    /** @test */    public function it_can_display_index()
    {
        $response = $this->actingAs($this->user)->get(route('profile.index'));

        $response->assertStatus(200);
        $response->assertViewHas('user');
    }

    /** @test */    public function it_can_display_edit()
    {
        $response = $this->actingAs($this->user)->get(route('profile.edit'));

        $response->assertStatus(200);
        $response->assertViewHas('user');
    }

    /** @test */    public function it_can_update_profile()
    {
        $data = [
            'name' => 'Nouveau Nom',
            'email' => 'nouveau@email.com',
        ];

        $response = $this->actingAs($this->user)->put(route('profile.update'), $data);

        $response->assertRedirect(route('profile.index'));
        $this->assertDatabaseHas('users', ['name' => 'Nouveau Nom']);
    }

    /** @test */    public function it_can_update_password()
    {
        $data = [
            'current_password' => 'password',
            'new_password' => 'newpassword',
            'new_password_confirmation' => 'newpassword',
        ];

        $response = $this->actingAs($this->user)->post(route('profile.update.password'), $data);

        $response->assertRedirect(route('profile.index'));
    }

    /** @test */    public function unauthenticated_cannot_access_profile()
    {
        $response = $this->get(route('profile.index'));

        $response->assertRedirect(route('login'));
    }
}