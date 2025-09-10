<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Module;
use App\Models\Filiere;
use App\Models\Groupe;
use App\Models\Seance;
use App\Models\Semistre;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_module_creation()
    {
        $filiere = Filiere::factory()->create();
        $semestre = Semistre::factory()->create();
        
        $module = Module::factory()->create([
            'nom_module' => 'Base de données',
            'id_filiere' => $filiere->id_filiere,
            'id_semestre' => $semestre->id_semestre
        ]);

        $this->assertDatabaseHas('modules', [
            'nom_module' => 'Base de données',
            'id_filiere' => $filiere->id_filiere
        ]);
    }

    public function test_module_filiere_relationship()
    {
        $filiere = Filiere::factory()->create();
        $module = Module::factory()->create(['id_filiere' => $filiere->id_filiere]);

        $this->assertInstanceOf(Filiere::class, $module->filiere);
        $this->assertEquals($filiere->id_filiere, $module->filiere->id_filiere);
    }

    public function test_module_groupes_relationship()
    {
        $module = Module::factory()->create();
        $groupe = Groupe::factory()->create();
        $module->groupes()->attach($groupe);

        $this->assertTrue($module->groupes->contains($groupe));
        $this->assertInstanceOf(Groupe::class, $module->groupes->first());
    }

    public function test_module_seances_relationship()
    {
        $module = Module::factory()->create();
        $seance = Seance::factory()->create(['id_module' => $module->id_module]);

        $this->assertTrue($module->seances->contains($seance));
        $this->assertInstanceOf(Seance::class, $module->seances->first());
    }

    public function test_module_semestre_relationship()
    {
        $semestre = Semistre::factory()->create();
        $module = Module::factory()->create(['id_semestre' => $semestre->id_semestre]);

$this->assertInstanceOf(Semistre::class, $module->semestre);
$this->assertEquals($semestre->id_semestre, $module->semestre->id_semestre);    }
}