<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Policies existantes...
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // Version alternative basée sur les noms de rôles (si vous utilisez les deux systèmes)
        Gate::define('admin-role', function ($user) {
            return $user->role->nom === 'Administrateur'; // Adaptez selon votre structure DB
        });
    }
}