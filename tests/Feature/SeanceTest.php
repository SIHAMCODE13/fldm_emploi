<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Seance;
use App\Models\Module;
use App\Models\Salle;
use App\Models\Groupe;
use App\Models\User;
use App\Models\Filiere;
use App\Models\Semistre;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeanceTest extends TestCase
{
    use RefreshDatabase;

    public function test_seance_creation()
    {
        $module = Module::factory()->create();
        $salle = Salle::factory()->create();
        $groupe = Groupe::factory()->create();
        $enseignant = User::factory()->create(['id_role' => 2]);
        $filiere = Filiere::factory()->create();
        $semestre = Semistre::factory()->create();

        $seance = Seance::factory()->create([
            'id_module' => $module->id_module,
            'id_salle' => $salle->id_salle,
            'id_groupe' => $groupe->id_groupe,
            'user_id' => $enseignant->id,
            'id_filiere' => $filiere->id_filiere,
            'id_semestre' => $semestre->id_semestre,
            'jour' => 'lundi',
            'debut' => '08:30',
            'fin' => '10:30',
            'type_seance' => 'Cours'
        ]);

        $this->assertDatabaseHas('seances', [
            'id_module' => $module->id_module,
            'id_salle' => $salle->id_salle,
            'jour' => 'lundi'
        ]);
    }

    public function test_seance_module_relationship()
    {
        $module = Module::factory()->create();
        $seance = Seance::factory()->create(['id_module' => $module->id_module]);

        $this->assertInstanceOf(Module::class, $seance->module);
        $this->assertEquals($module->id_module, $seance->module->id_module);
    }

    public function test_seance_salle_relationship()
    {
        $salle = Salle::factory()->create();
        $seance = Seance::factory()->create(['id_salle' => $salle->id_salle]);

        $this->assertInstanceOf(Salle::class, $seance->salle);
        $this->assertEquals($salle->id_salle, $seance->salle->id_salle);
    }

    public function test_seance_groupe_relationship()
    {
        $groupe = Groupe::factory()->create();
        $seance = Seance::factory()->create(['id_groupe' => $groupe->id_groupe]);

        $this->assertInstanceOf(Groupe::class, $seance->groupe);
        $this->assertEquals($groupe->id_groupe, $seance->groupe->id_groupe);
    }

    public function test_seance_enseignant_relationship()
    {
        $enseignant = User::factory()->create(['id_role' => 2]);
        $seance = Seance::factory()->create(['user_id' => $enseignant->id]);

        $this->assertInstanceOf(User::class, $seance->enseignant);
        $this->assertEquals($enseignant->id, $seance->enseignant->id);
    }

    public function test_seance_filiere_relationship()
    {
        $filiere = Filiere::factory()->create();
        $seance = Seance::factory()->create(['id_filiere' => $filiere->id_filiere]);

        $this->assertInstanceOf(Filiere::class, $seance->filiere);
        $this->assertEquals($filiere->id_filiere, $seance->filiere->id_filiere);
    }

    public function test_seance_semestre_relationship()
    {
        $semestre = Semistre::factory()->create();
        $seance = Seance::factory()->create(['id_semestre' => $semestre->id_semestre]);

$this->assertInstanceOf(Semistre::class, $seance->semestre);
$this->assertEquals($semestre->id_semestre, $seance->semestre->id_semestre);    }
}