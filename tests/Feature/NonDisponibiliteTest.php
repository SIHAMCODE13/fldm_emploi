<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\NonDisponibilite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NonDisponibiliteTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_disponibilite_creation()
    {
        $enseignant = User::factory()->create(['id_role' => 2]);
        
        $nonDispo = NonDisponibilite::factory()->create([
            'enseignant_id' => $enseignant->id,
            'date_debut' => '2023-12-01',
            'date_fin' => '2023-12-02',
            'type_periode' => 'journee',
            'periode' => 'journee_complete',
            'raison' => 'Maladie',
            'statut' => 'en_attente'
        ]);

        $this->assertDatabaseHas('non_disponibilites', [
            'enseignant_id' => $enseignant->id,
            'raison' => 'Maladie',
            'statut' => 'en_attente'
        ]);
    }

    public function test_non_disponibilite_enseignant_relationship()
    {
        $enseignant = User::factory()->create(['id_role' => 2]);
        $nonDispo = NonDisponibilite::factory()->create(['enseignant_id' => $enseignant->id]);

        $this->assertInstanceOf(User::class, $nonDispo->enseignant);
        $this->assertEquals($enseignant->id, $nonDispo->enseignant->id);
    }

    public function test_periode_check_methods()
    {
        $journeeComplete = NonDisponibilite::factory()->create(['type_periode' => 'journee']);
        $periodeSpecifique = NonDisponibilite::factory()->create(['type_periode' => 'periode']);

        $this->assertTrue($journeeComplete->isJourneeComplete());
        $this->assertFalse($journeeComplete->isPeriodeSpecifique());

        $this->assertTrue($periodeSpecifique->isPeriodeSpecifique());
        $this->assertFalse($periodeSpecifique->isJourneeComplete());
    }

    public function test_date_casting()
    {
        $nonDispo = NonDisponibilite::factory()->create([
            'date_debut' => '2023-12-01',
            'date_fin' => '2023-12-02'
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $nonDispo->date_debut);
        $this->assertInstanceOf(\Carbon\Carbon::class, $nonDispo->date_fin);
        $this->assertEquals('2023-12-01', $nonDispo->date_debut->format('Y-m-d'));
    }
}