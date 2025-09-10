<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

public function test_admin_can_authenticate_and_redirect_to_home()
{
    $admin = User::factory()->create(['id_role' => 1]);

    $response = $this->post('/login', [
        'email' => $admin->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect('/home');
}

public function test_teacher_can_authenticate_and_redirect_to_dashboard()
{
    $teacher = User::factory()->create(['id_role' => 2]);

    $response = $this->post('/login', [
        'email' => $teacher->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect('/enseignant/dashboard');
}

// public function test_student_can_authenticate_and_redirect_to_appropriate_page()
// {
//     $student = User::factory()->create(['id_role' => 3]);

//     $response = $this->post('/login', [
//         'email' => $student->email,
//         'password' => 'password',
//     ]);

//     $this->assertAuthenticated();
//     // Adaptez selon où les étudiants sont redirigés
//     $response->assertRedirect('/etudiant/dashboard');
// }
    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create(['id_role' => 2]);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout()
    {
        $user = User::factory()->create(['id_role' => 2]);

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}