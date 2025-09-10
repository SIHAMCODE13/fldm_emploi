<?php

namespace App\Http\Controllers\Api;

use App\Models\NonDisponibilite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NonDisponibiliteController extends Controller
{
    public function index()
    {
        $nonDisponibilites = NonDisponibilite::with('enseignant')->get();
        
        return response()->json([
            'data' => $nonDisponibilites
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'enseignant_id' => 'required|exists:users,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'type_periode' => 'required|in:journee,periode',
            'periode' => 'nullable|required_if:type_periode,periode|in:matin,apres-midi',
            'raison' => 'required|string|max:255',
            'statut' => 'sometimes|in:en_attente,approuve,rejete'
        ]);

        $nonDisponibilite = NonDisponibilite::create($validated);

        return response()->json([
            'data' => $nonDisponibilite->load('enseignant')
        ], Response::HTTP_CREATED);
    }

    public function show(NonDisponibilite $nonDisponibilite)
    {
        return response()->json([
            'data' => $nonDisponibilite->load('enseignant')
        ], Response::HTTP_OK);
    }

    public function update(Request $request, NonDisponibilite $nonDisponibilite)
    {
        $validated = $request->validate([
            'date_debut' => 'sometimes|date',
            'date_fin' => 'sometimes|date|after_or_equal:date_debut',
            'type_periode' => 'sometimes|in:journee,periode',
            'periode' => 'nullable|required_if:type_periode,periode|in:matin,apres-midi',
            'raison' => 'sometimes|string|max:255',
            'statut' => 'sometimes|in:en_attente,approuve,rejete'
        ]);

        $nonDisponibilite->update($validated);

        return response()->json([
            'data' => $nonDisponibilite->load('enseignant')
        ], Response::HTTP_OK);
    }

    public function destroy(NonDisponibilite $nonDisponibilite)
    {
        $nonDisponibilite->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}