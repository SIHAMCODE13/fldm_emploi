<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Définition des Gates basées sur id_role (version simplifiée)
        Gate::define('admin', fn($user) => $user->id_role === 1);
        Gate::define('enseignant', fn($user) => $user->id_role === 2);
        Gate::define('etudiant', fn($user) => $user->id_role === 3);
        
        // Gate combinée
        Gate::define('admin-or-enseignant', fn($user) => in_array($user->id_role, [1, 2]));
    }
}