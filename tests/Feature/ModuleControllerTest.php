<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Module;
use App\Models\Filiere;
use App\Models\Semistre;
use App\Models\User;

class ModuleControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['id_role' => 1]);
    }

    /** @test */    public function it_can_list_modules()
    {
        Module::factory()->count(3)->create();

        $response = $this->actingAs($this->admin)->get(route('modules.index'));

        $response->assertStatus(200);
        $response->assertViewHas('modules');
    }

    /** @test */    public function it_can_create_module()
    {
        $filiere = Filiere::factory()->create();
        $semestre = Semistre::factory()->create();

        $data = [
            'nom_module' => 'Nouveau Module',
            'id_filiere' => $filiere->id_filiere,
            'id_semestre' => $semestre->id_semestre,
        ];

        $response = $this->actingAs($this->admin)->post(route('modules.store'), $data);

        $response->assertRedirect(route('modules.index'));
        $this->assertDatabaseHas('modules', ['nom_module' => 'Nouveau Module']);
    }

    /** @test */    public function it_can_update_module()
    {
        $module = Module::factory()->create();

        $data = [
            'nom_module' => 'Module Modifié',
            'id_filiere' => Filiere::factory()->create()->id_filiere,
            'id_semestre' => Semistre::factory()->create()->id_semestre,
        ];

        $response = $this->actingAs($this->admin)->put(route('modules.update', $module->id_module), $data);

        $response->assertRedirect(route('modules.index'));
        $this->assertDatabaseHas('modules', ['nom_module' => 'Module Modifié']);
    }

    /** @test */    public function it_can_destroy_module()
    {
        $module = Module::factory()->create();

        $response = $this->actingAs($this->admin)->delete(route('modules.destroy', $module->id_module));

        $response->assertRedirect(route('modules.index'));
        $this->assertDatabaseMissing('modules', ['id_module' => $module->id_module]);
    }

    /** @test */    public function non_admin_cannot_access_modules_index()
    {
        $user = User::factory()->create(['id_role' => 2]);

        $response = $this->actingAs($user)->get(route('modules.index'));

        $response->assertStatus(403);
    }
}