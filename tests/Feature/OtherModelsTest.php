<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Cycle;
use App\Models\Parcours;
use App\Models\Semistre;
use App\Models\Filiere;
use App\Models\Groupe;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OtherModelsTest extends TestCase
{
    use RefreshDatabase;

    public function test_cycle_creation_and_relationships()
    {
        $cycle = Cycle::factory()->create([
            'code_cycle' => 'L',
            'cycle' => 'Licence',
            'cycle_ar' => 'الإجازة'
        ]);

        $filiere = Filiere::factory()->create();
        $cycle->filieres()->attach($filiere);

        $this->assertDatabaseHas('cycles', [
            'code_cycle' => 'L',
            'cycle' => 'Licence'
        ]);

        $this->assertTrue($cycle->filieres->contains($filiere));
        $this->assertInstanceOf(Filiere::class, $cycle->filieres->first());
    }

    public function test_parcours_creation_and_relationships()
    {
        $filiere = Filiere::factory()->create();
        
        $parcours = Parcours::factory()->create([
            'code_parcours' => 'GL',
            'parcours' => 'Génie Logiciel',
            'parcours_ar' => 'هندسة البرمجيات',
            'id_filiere' => $filiere->id_filiere
        ]);

        $this->assertDatabaseHas('parcours', [
            'code_parcours' => 'GL',
            'parcours' => 'Génie Logiciel'
        ]);

        $this->assertInstanceOf(Filiere::class, $parcours->filiere);
        $this->assertEquals($filiere->id_filiere, $parcours->filiere->id_filiere);
    }

    public function test_semistre_creation_and_relationships()
    {
        $semestre = Semistre::factory()->create([
            'nom_semestre' => 'Semestre 1'
        ]);

        $groupe = Groupe::factory()->create(['id_semestre' => $semestre->id_semestre]);
        $module = Module::factory()->create(['id_semestre' => $semestre->id_semestre]);

        $this->assertDatabaseHas('semistres', [
            'nom_semestre' => 'Semestre 1'
        ]);

        $this->assertTrue($semestre->groupes->contains($groupe));
        $this->assertInstanceOf(Groupe::class, $semestre->groupes->first());

        $this->assertTrue($semestre->modules->contains($module));
        $this->assertInstanceOf(Module::class, $semestre->modules->first());
    }
}