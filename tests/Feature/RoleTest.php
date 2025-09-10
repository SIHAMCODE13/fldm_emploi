<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_role_creation()
    {
        $role = Role::factory()->create([
            'nom' => 'Administrateur',
            'permission' => 'all'
        ]);

        $this->assertDatabaseHas('roles', [
            'nom' => 'Administrateur',
            'permission' => 'all'
        ]);
    }

    public function test_role_users_relationship()
    {
        $role = Role::factory()->create(['id_role' => 1]);
        $user = User::factory()->create(['id_role' => $role->id_role]);

        $this->assertTrue($role->users->contains($user));
        $this->assertInstanceOf(User::class, $role->users->first());
    }

    public function test_role_has_correct_attributes()
    {
        $role = Role::factory()->create([
            'nom' => 'Enseignant',
            'permission' => 'teacher_access'
        ]);

        $this->assertEquals('Enseignant', $role->nom);
        $this->assertEquals('teacher_access', $role->permission);
    }
}