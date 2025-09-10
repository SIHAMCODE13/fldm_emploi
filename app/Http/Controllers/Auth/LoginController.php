<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Ce contrôleur gère l'authentification des utilisateurs et la
    | redirection vers leurs dashboards respectifs après connexion.
    | Il utilise le trait AuthenticatesUsers pour simplifier le processus.
    |
    */

    use AuthenticatesUsers;

    /**
     * Redirection par défaut après login (peut être surchargée)
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Cette méthode est appelée après connexion réussie.
     * Elle redirige selon le rôle : admin -> /home, enseignant -> /enseignant/dashboard
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('home');
        }

        if ($user->isTeacher()) {
            return redirect()->route('enseignant.dashboard');
        }

        // Redirection par défaut si rôle inconnu
        return redirect('/');
    }
}