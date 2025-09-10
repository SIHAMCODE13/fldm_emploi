<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Salle;
use App\Models\Seance;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalleTest extends TestCase
{
    use RefreshDatabase;

    public function test_salle_creation()
    {
        $salle = Salle::factory()->create([
            'nom_salle' => 'Salle 101',
            'capacite' => 30,
            'disponibilite' => true
        ]);

        $this->assertDatabaseHas('salles', [
            'nom_salle' => 'Salle 101',
            'capacite' => 30,
            'disponibilite' => true
        ]);
    }

    public function test_salle_seances_relationship()
    {
        $salle = Salle::factory()->create();
        $seance = Seance::factory()->create(['id_salle' => $salle->id_salle]);

        $this->assertTrue($salle->seances->contains($seance));
        $this->assertInstanceOf(Seance::class, $salle->seances->first());
    }

    public function test_salle_has_correct_attributes()
    {
        $salle = Salle::factory()->create([
            'nom_salle' => 'Amphithéâtre A',
            'capacite' => 100,
            'disponibilite' => false
        ]);

        $this->assertEquals('Amphithéâtre A', $salle->nom_salle);
        $this->assertEquals(100, $salle->capacite);
        $this->assertFalse($salle->disponibilite);
    }
}