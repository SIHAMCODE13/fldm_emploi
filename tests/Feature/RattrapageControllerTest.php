<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Rattrapage;
use App\Models\User;

class RattrapageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['id_role' => 1]);
    }

    /** @test */

    public function it_can_list_rattrapages()
    {
        Rattrapage::factory()->count(3)->create();

        $response = $this->actingAs($this->admin)->get(route('admin.rattrapages'));

        $response->assertStatus(200);
    }



    /** @test */

    public function non_admin_cannot_access_rattrapages()
    {
        $user = User::factory()->create(['id_role' => 2]);

        $response = $this->actingAs($user)->get(route('admin.rattrapages'));

        $response->assertStatus(403);
    }
}