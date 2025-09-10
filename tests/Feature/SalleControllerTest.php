<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Salle;
use App\Models\User;

class SalleControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['id_role' => 1]);
    }

    /** @test */
    public function it_can_list_salles()
    {
        Salle::factory()->count(3)->create();

        $response = $this->actingAs($this->admin)->get(route('salles.index'));

        $response->assertStatus(200);
        $response->assertViewHas('salles');
    }

    /** @test */
    public function it_can_create_salle()
    {
        $data = [
            'nom_salle' => 'Nouvelle Salle',
            'capacite' => 50,
            'disponibilite' => true,
        ];

        $response = $this->actingAs($this->admin)->post(route('salles.store'), $data);

        $response->assertRedirect(route('salles.index'));
        $this->assertDatabaseHas('salles', ['nom_salle' => 'Nouvelle Salle']);
    }

    /** @test */
    public function it_validates_create_salle()
    {
        $response = $this->actingAs($this->admin)->post(route('salles.store'), []);

        $response->assertSessionHasErrors(['nom_salle', 'capacite', 'disponibilite']);
    }

    /** @test */
    public function it_can_edit_salle()
    {
        $salle = Salle::factory()->create();

        $response = $this->actingAs($this->admin)->get(route('salles.edit', $salle->id_salle));

        $response->assertStatus(200);
        $response->assertViewHas('salle');
    }

    /** @test */
    public function it_can_update_salle()
    {
        $salle = Salle::factory()->create();

        $data = [
            'nom_salle' => 'Salle Modifiée',
            'capacite' => 60,
            'disponibilite' => false,
        ];

        $response = $this->actingAs($this->admin)->put(route('salles.update', $salle->id_salle), $data);

        $response->assertRedirect(route('salles.index'));
        $this->assertDatabaseHas('salles', ['nom_salle' => 'Salle Modifiée']);
    }

    /** @test */
    public function it_can_destroy_salle()
    {
        $salle = Salle::factory()->create();

        $response = $this->actingAs($this->admin)->delete(route('salles.destroy', $salle->id_salle));

        $response->assertRedirect(route('salles.index'));
        $this->assertDatabaseMissing('salles', ['id_salle' => $salle->id_salle]);
    }

    /** @test */
    public function non_admin_cannot_access_salles_index()
    {
        $user = User::factory()->create(['id_role' => 2]);

        $response = $this->actingAs($user)->get(route('salles.index'));

        $response->assertStatus(403);
    }
}