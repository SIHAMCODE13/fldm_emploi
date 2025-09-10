<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */    public function it_can_display_home()
    {
        $user = User::factory()->create(['id_role' => 1]);

        $response = $this->actingAs($user)->get(route('home'));

        $response->assertStatus(200);
    }

    /** @test */    public function unauthenticated_cannot_access_home()
    {
        $response = $this->get(route('home'));

        $response->assertRedirect(route('login'));
    }
}