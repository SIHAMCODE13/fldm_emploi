<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Seance;
use App\Models\User;
use App\Models\Filiere;
use App\Models\Groupe;
use App\Models\Semistre;
use App\Models\Salle;
use App\Models\Module;
use PHPUnit\Framework\Attributes\Test;

class SeanceControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['id_role' => 1]);
    }

    /** @test */
    public function it_can_list_seances()
    {
        Seance::factory()->count(3)->create();

        $response = $this->actingAs($this->admin)->get(route('emplois.index'));

        $response->assertStatus(200);
        $response->assertViewHas('seances');
    }

    /** @test */
    public function it_can_create_seance()
    {
        $filiere = Filiere::factory()->create();
        $groupe = Groupe::factory()->create(['id_filiere' => $filiere->id_filiere]);
        $semestre = Semistre::factory()->create();
        $salle = Salle::factory()->create(['disponibilite' => 1]);
        $module = Module::factory()->create(['id_filiere' => $filiere->id_filiere, 'id_semestre' => $semestre->id_semestre]);
        $enseignant = User::factory()->create(['id_role' => 2]);

        $data = [
            'filiere_id' => $filiere->id_filiere,
            'groupe_id' => $groupe->id_groupe,
            'semestre_id' => $semestre->id_semestre,
            'seances' => [
                'lundi' => [
                    '08:30 - 10:30' => [
                        'module_id' => $module->id_module,
                        'salle_id' => $salle->id_salle,
                        'type_seance' => 'Cours',
                        'user_id' => $enseignant->id,
                    ],
                ],
            ],
        ];

        $response = $this->actingAs($this->admin)->post(route('emplois.store'), $data);

        $response->assertRedirect(route('emplois.index', [
            'filiere_id' => $filiere->id_filiere,
            'groupe_id' => $groupe->id_groupe,
            'semestre_id' => $semestre->id_semestre,
        ]));
        $this->assertDatabaseHas('seances', [
            'id_filiere' => $filiere->id_filiere,
            'id_groupe' => $groupe->id_groupe,
            'id_semestre' => $semestre->id_semestre,
            'jour' => 'lundi',
            'debut' => '08:30',
            'fin' => '10:30',
            'id_module' => $module->id_module,
            'id_salle' => $salle->id_salle,
            'type_seance' => 'Cours',
            'user_id' => $enseignant->id,
        ]);
    }

    /** @test */
    public function it_can_update_seance()
    {
        $filiere = Filiere::factory()->create();
        $groupe = Groupe::factory()->create(['id_filiere' => $filiere->id_filiere]);
        $semestre = Semistre::factory()->create();
        $salle = Salle::factory()->create(['disponibilite' => 1]);
        $module = Module::factory()->create(['id_filiere' => $filiere->id_filiere, 'id_semestre' => $semestre->id_semestre]);
        $enseignant = User::factory()->create(['id_role' => 2]);

        $seance = Seance::factory()->create([
            'id_filiere' => $filiere->id_filiere,
            'id_groupe' => $groupe->id_groupe,
            'id_semestre' => $semestre->id_semestre,
        ]);

        $data = [
            'type_seance' => 'TD',
            'id_salle' => $salle->id_salle,
            'user_id' => $enseignant->id,
            'id_module' => $module->id_module,
        ];

        $response = $this->actingAs($this->admin)->put(route('emplois.update', $seance->id_seance), $data);

        $response->assertRedirect(route('emplois.index', [
            'filiere_id' => $filiere->id_filiere,
            'groupe_id' => $groupe->id_groupe,
            'semestre_id' => $semestre->id_semestre,
        ]));
        $this->assertDatabaseHas('seances', [
            'id_seance' => $seance->id_seance,
            'type_seance' => 'TD',
            'id_salle' => $salle->id_salle,
            'user_id' => $enseignant->id,
            'id_module' => $module->id_module,
        ]);
    }

    /** @test */
    public function it_can_destroy_seance()
    {
        $filiere = Filiere::factory()->create();
        $groupe = Groupe::factory()->create(['id_filiere' => $filiere->id_filiere]);
        $semestre = Semistre::factory()->create();
        $seance = Seance::factory()->create([
            'id_filiere' => $filiere->id_filiere,
            'id_groupe' => $groupe->id_groupe,
            'id_semestre' => $semestre->id_semestre,
        ]);

        $response = $this->actingAs($this->admin)->delete(route('emplois.destroy', $seance->id_seance));

        $response->assertRedirect(route('emplois.index', [
            'filiere_id' => $filiere->id_filiere,
            'groupe_id' => $groupe->id_groupe,
            'semestre_id' => $semestre->id_semestre,
        ]));
        $this->assertDatabaseMissing('seances', ['id_seance' => $seance->id_seance]);
    }

    /** @test */
    public function non_admin_cannot_access_seances_index()
    {
        $user = User::factory()->create(['id_role' => 2]);

        $response = $this->actingAs($user)->get(route('emplois.index'));

        $response->assertStatus(403);
    }
}