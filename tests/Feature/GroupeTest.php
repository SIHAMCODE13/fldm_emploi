<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Groupe;
use App\Models\Filiere;
use App\Models\Semistre;
use App\Models\User;
use App\Models\Module;
use App\Models\Seance;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GroupeTest extends TestCase
{
    use RefreshDatabase;

    public function test_groupe_creation()
    {
        $filiere = Filiere::factory()->create();
        $semestre = Semistre::factory()->create();
        
        $groupe = Groupe::factory()->create([
            'nom_groupe' => 'Groupe A',
            'id_filiere' => $filiere->id_filiere,
            'id_semestre' => $semestre->id_semestre
        ]);

        $this->assertDatabaseHas('groupes', [
            'nom_groupe' => 'Groupe A',
            'id_filiere' => $filiere->id_filiere
        ]);
    }

    public function test_groupe_filiere_relationship()
    {
        $filiere = Filiere::factory()->create();
        $groupe = Groupe::factory()->create(['id_filiere' => $filiere->id_filiere]);

        $this->assertInstanceOf(Filiere::class, $groupe->filiere);
        $this->assertEquals($filiere->id_filiere, $groupe->filiere->id_filiere);
    }

    public function test_groupe_semestre_relationship()
    {
        $semestre = Semistre::factory()->create();
        $groupe = Groupe::factory()->create(['id_semestre' => $semestre->id_semestre]);

        $this->assertInstanceOf(Semistre::class, $groupe->semestre);
        $this->assertEquals($semestre->id_semestre, $groupe->semestre->id_semestre);
    }

    public function test_groupe_users_relationship()
    {
        $groupe = Groupe::factory()->create();
        $user = User::factory()->create();
        $groupe->users()->attach($user, ['annee_scolaire' => '2023-2024']);

        $this->assertTrue($groupe->users->contains($user));
        $this->assertInstanceOf(User::class, $groupe->users->first());
        $this->assertEquals('2023-2024', $groupe->users->first()->pivot->annee_scolaire);
    }

    public function test_groupe_modules_relationship()
    {
        $groupe = Groupe::factory()->create();
        $module = Module::factory()->create();
        $groupe->modules()->attach($module);

        $this->assertTrue($groupe->modules->contains($module));
        $this->assertInstanceOf(Module::class, $groupe->modules->first());
    }

    public function test_groupe_seances_relationship()
    {
        $groupe = Groupe::factory()->create();
        $seance = Seance::factory()->create(['id_groupe' => $groupe->id_groupe]);

        $this->assertTrue($groupe->seances->contains($seance));
        $this->assertInstanceOf(Seance::class, $groupe->seances->first());
    }
}