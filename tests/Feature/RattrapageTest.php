<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Rattrapage;
use App\Models\User;
use App\Models\Salle;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RattrapageTest extends TestCase
{
    use RefreshDatabase;

    public function test_rattrapage_creation()
    {
        $enseignant = User::factory()->create(['id_role' => 2]);
        
        $rattrapage = Rattrapage::factory()->create([
            'user_id' => $enseignant->id,
            'date' => '2023-12-15',
            'periode' => '8:30h-10:30h',
            'type_seance' => 'Cours',
            'module' => 'Base de données',
            'groupe' => 'Groupe A',
            'statut' => 'en_attente'
        ]);

        $this->assertDatabaseHas('rattrapages', [
            'user_id' => $enseignant->id,
            'module' => 'Base de données',
            'statut' => 'en_attente'
        ]);
    }

    public function test_rattrapage_user_relationship()
    {
        $enseignant = User::factory()->create(['id_role' => 2]);
        $rattrapage = Rattrapage::factory()->create(['user_id' => $enseignant->id]);

        $this->assertInstanceOf(User::class, $rattrapage->user);
        $this->assertEquals($enseignant->id, $rattrapage->user->id);
    }

    public function test_rattrapage_enseignant_relationship()
    {
        $enseignant = User::factory()->create(['id_role' => 2]);
        $rattrapage = Rattrapage::factory()->create(['user_id' => $enseignant->id]);

        $this->assertInstanceOf(User::class, $rattrapage->enseignant);
        $this->assertEquals($enseignant->id, $rattrapage->enseignant->id);
    }

    public function test_rattrapage_salle_relationship()
    {
        $salle = Salle::factory()->create();
        $rattrapage = Rattrapage::factory()->create(['salle_attribuee' => $salle->id_salle]);

        $this->assertInstanceOf(Salle::class, $rattrapage->salle);
        $this->assertEquals($salle->id_salle, $rattrapage->salle->id_salle);
    }

    public function test_status_check_methods()
    {
        $enAttente = Rattrapage::factory()->create(['statut' => 'en_attente']);
        $approuve = Rattrapage::factory()->create(['statut' => 'approuve']);
        $rejete = Rattrapage::factory()->create(['statut' => 'rejete']);

        $this->assertTrue($enAttente->isEnAttente());
        $this->assertFalse($enAttente->isApprouve());
        $this->assertFalse($enAttente->isRejete());

        $this->assertTrue($approuve->isApprouve());
        $this->assertFalse($approuve->isEnAttente());
        $this->assertFalse($approuve->isRejete());

        $this->assertTrue($rejete->isRejete());
        $this->assertFalse($rejete->isEnAttente());
        $this->assertFalse($rejete->isApprouve());
    }

    public function test_date_casting()
    {
        $rattrapage = Rattrapage::factory()->create(['date' => '2023-12-15']);

        $this->assertInstanceOf(\Carbon\Carbon::class, $rattrapage->date);
        $this->assertEquals('2023-12-15', $rattrapage->date->format('Y-m-d'));
    }
}