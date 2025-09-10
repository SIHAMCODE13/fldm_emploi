<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Filiere;
use App\Models\Departement;
use App\Models\Module;
use App\Models\Groupe;
use App\Models\Parcours;
use App\Models\Cycle;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FiliereTest extends TestCase
{
    use RefreshDatabase;

    public function test_filiere_creation()
    {
        $departement = Departement::factory()->create();
        $filiere = Filiere::factory()->create([
            'nom_filiere' => 'Génie Logiciel',
            'id_departement' => $departement->id_departement
        ]);

        $this->assertDatabaseHas('filieres', [
            'nom_filiere' => 'Génie Logiciel',
            'id_departement' => $departement->id_departement
        ]);
    }

    public function test_filiere_departement_relationship()
    {
        $departement = Departement::factory()->create();
        $filiere = Filiere::factory()->create(['id_departement' => $departement->id_departement]);

        $this->assertInstanceOf(Departement::class, $filiere->departement);
        $this->assertEquals($departement->id_departement, $filiere->departement->id_departement);
    }

    public function test_filiere_modules_relationship()
    {
        $filiere = Filiere::factory()->create();
        $module = Module::factory()->create(['id_filiere' => $filiere->id_filiere]);

        $this->assertTrue($filiere->modules->contains($module));
        $this->assertInstanceOf(Module::class, $filiere->modules->first());
    }

    public function test_filiere_groupes_relationship()
    {
        $filiere = Filiere::factory()->create();
        $groupe = Groupe::factory()->create(['id_filiere' => $filiere->id_filiere]);

        $this->assertTrue($filiere->groupes->contains($groupe));
        $this->assertInstanceOf(Groupe::class, $filiere->groupes->first());
    }

    public function test_filiere_parcours_relationship()
    {
        $filiere = Filiere::factory()->create();
        $parcours = Parcours::factory()->create(['id_filiere' => $filiere->id_filiere]);

        $this->assertTrue($filiere->parcours->contains($parcours));
        $this->assertInstanceOf(Parcours::class, $filiere->parcours->first());
    }

    public function test_filiere_cycles_relationship()
    {
        $filiere = Filiere::factory()->create();
        $cycle = Cycle::factory()->create();
        $filiere->cycles()->attach($cycle);

        $this->assertTrue($filiere->cycles->contains($cycle));
        $this->assertInstanceOf(Cycle::class, $filiere->cycles->first());
    }
}