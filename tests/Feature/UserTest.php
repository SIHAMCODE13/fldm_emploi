<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_creation()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'id_role' => 2
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'name' => 'John Doe'
        ]);
    }

    public function test_user_role_relationship()
    {
        $role = Role::factory()->create(['id_role' => 2, 'nom' => 'Enseignant']);
        $user = User::factory()->create(['id_role' => $role->id_role]);

        $this->assertInstanceOf(Role::class, $user->role);
        $this->assertEquals('Enseignant', $user->role->nom);
    }

    public function test_role_check_methods()
    {
        $admin = User::factory()->create(['id_role' => 1]);
        $teacher = User::factory()->create(['id_role' => 2]);
        $student = User::factory()->create(['id_role' => 3]);

        $this->assertTrue($admin->isAdmin());
        $this->assertFalse($admin->isTeacher());
        $this->assertFalse($admin->isStudent());

        $this->assertTrue($teacher->isTeacher());
        $this->assertFalse($teacher->isAdmin());
        $this->assertFalse($teacher->isStudent());

        $this->assertTrue($student->isStudent());
        $this->assertFalse($student->isAdmin());
        $this->assertFalse($student->isTeacher());
    }

    public function test_user_has_correct_attributes()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'id_role' => 2
        ]);

        $this->assertEquals('Test User', $user->name);
        $this->assertEquals('test@example.com', $user->email);
        $this->assertEquals(2, $user->id_role);
    }
}