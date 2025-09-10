<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Affiche la page de profil (vue en lecture seule)
     */
    public function index()
    {
        $user = Auth::user();
        
        return view('profile.index', [
            'user' => $user,
            'lastUpdated' => $user->updated_at ? $user->updated_at->diffForHumans() : 'Jamais mis à jour'
        ]);
    }

    /**
     * Affiche le formulaire d'édition du profil
     */
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Met à jour les informations du profil
     *
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'current_password' => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        // Mise à jour des informations de base
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Mise à jour du mot de passe si fourni
        if ($request->filled('new_password')) {
            $user->password = Hash::make($validatedData['new_password']);
        }

        $user->save();

        return redirect()->route('profile.index')
            ->with('success', 'Votre profil a été mis à jour avec succès.');
    }

    /**
     * Met à jour uniquement le mot de passe
     *
     * @throws ValidationException
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->password = Hash::make($validatedData['new_password']);
        $user->save();

        return redirect()->route('profile.index')
            ->with('success', 'Votre mot de passe a été mis à jour avec succès.');
    }
}