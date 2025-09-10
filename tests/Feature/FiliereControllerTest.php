<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Filiere;
use App\Models\Departement;
use App\Models\User;

class FiliereControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['id_role' => 1]);
    }

    /** @test */

    public function it_can_list_filieres()
    {
        $departement = Departement::factory()->create();
        Filiere::factory()->count(3)->create(['id_departement' => $departement->id_departement]);

        $response = $this->actingAs($this->admin)->get(route('filieres.index'));

        $response->assertStatus(200);
        $response->assertViewHas('filieres');
    }

    /** @test */

    public function it_can_create_filiere()
    {
        $departement = Departement::factory()->create();

        $data = [
            'nom_filiere' => 'Nouvelle Filière',
            'id_departement' => $departement->id_departement,
        ];

        $response = $this->actingAs($this->admin)->post(route('filieres.store'), $data);

        $response->assertRedirect(route('filieres.index'));
        $this->assertDatabaseHas('filieres', ['nom_filiere' => 'Nouvelle Filière']);
    }

    /** @test */
    public function it_validates_create_filiere()
    {
        $response = $this->actingAs($this->admin)->post(route('filieres.store'), []);

        $response->assertSessionHasErrors(['nom_filiere', 'id_departement']);
    }

    /** @test */
    public function it_can_edit_filiere()
    {
        $filiere = Filiere::factory()->create();

        $response = $this->actingAs($this->admin)->get(route('filieres.edit', $filiere->id_filiere));

        $response->assertStatus(200);
        $response->assertViewHas('filiere');
    }

    /** @test */
    public function it_can_update_filiere()
    {
        $departement = Departement::factory()->create();
        $filiere = Filiere::factory()->create(['id_departement' => $departement->id_departement]);

        $data = [
            'nom_filiere' => 'Filière Modifiée',
            'id_departement' => $departement->id_departement,
        ];

        $response = $this->actingAs($this->admin)->put(route('filieres.update', $filiere->id_filiere), $data);

        $response->assertRedirect(route('filieres.index'));
        $this->assertDatabaseHas('filieres', ['nom_filiere' => 'Filière Modifiée']);
    }

    /** @test */
    public function it_can_destroy_filiere()
    {
        $filiere = Filiere::factory()->create();

        $response = $this->actingAs($this->admin)->delete(route('filieres.destroy', $filiere->id_filiere));

        $response->assertRedirect(route('filieres.index'));
        $this->assertDatabaseMissing('filieres', ['id_filiere' => $filiere->id_filiere]);
    }

    /** @test */
    public function non_admin_cannot_access_filieres_index()
    {
        $user = User::factory()->create(['id_role' => 2]);

        $response = $this->actingAs($user)->get(route('filieres.index'));

        $response->assertStatus(403);
    }
}