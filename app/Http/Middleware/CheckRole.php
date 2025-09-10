<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user() || $request->user()->role->nom !== $role) {
            abort(403, 'Accès non autorisé');
        }
        return $next($request);
    }
}
