<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Departement;
use App\Models\User;

class DepartementControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['id_role' => 1]); // Assuming id_role 1 is admin
    }

    /** @test */
    public function it_can_list_departements()
    {
        Departement::factory()->count(3)->create();

        $response = $this->actingAs($this->admin)->get(route('departements.index'));

        $response->assertStatus(200);
        $response->assertViewHas('departements');
    }

    /** @test */
    public function it_can_create_departement()
    {
        $data = [
            'nom' => 'Nouveau Département',
            'responsable' => 'John Doe',
        ];

        $response = $this->actingAs($this->admin)->post(route('departements.store'), $data);

        $response->assertRedirect(route('departements.index'));
        $this->assertDatabaseHas('departements', ['nom' => 'Nouveau Département']);
    }

    /** @test */
    public function it_validates_create_departement()
    {
        $response = $this->actingAs($this->admin)->post(route('departements.store'), []);

        $response->assertSessionHasErrors(['nom', 'responsable']);
    }

    /** @test */
    public function it_can_edit_departement()
    {
        $departement = Departement::factory()->create();

        $response = $this->actingAs($this->admin)->get(route('departements.edit', $departement->id_departement));

        $response->assertStatus(200);
        $response->assertViewHas('departement');
    }

    /** @test */
    public function it_can_update_departement()
    {
        $departement = Departement::factory()->create();

        $data = [
            'nom' => 'Département Modifié',
            'responsable' => 'Jane Doe',
        ];

        $response = $this->actingAs($this->admin)->put(route('departements.update', $departement->id_departement), $data);

        $response->assertRedirect(route('departements.index'));
        $this->assertDatabaseHas('departements', ['nom' => 'Département Modifié']);
    }

    /** @test */
    public function it_can_destroy_departement()
    {
        $departement = Departement::factory()->create();

        $response = $this->actingAs($this->admin)->delete(route('departements.destroy', $departement->id_departement));

        $response->assertRedirect(route('departements.index'));
        $this->assertDatabaseMissing('departements', ['id_departement' => $departement->id_departement]);
    }

    /** @test */
    public function non_admin_cannot_access_departements_index()
    {
        $user = User::factory()->create(['id_role' => 2]); // Non-admin

        $response = $this->actingAs($user)->get(route('departements.index'));

        $response->assertStatus(403);
    }
}