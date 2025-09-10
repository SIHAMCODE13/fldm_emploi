<?php

namespace App\Http\Controllers\Api;

use App\Models\Seance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SeanceController extends Controller
{
    public function index()
    {
        $seances = Seance::with(['module', 'salle', 'groupe', 'enseignant', 'filiere', 'semestre'])->get();
        
        return response()->json([
            'data' => $seances
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_filiere' => 'required|exists:filieres,id_filiere',
            'id_semestre' => 'required|exists:semistres,id_semestre',
            'jour' => 'required|string',
            'debut' => 'required|date_format:H:i',
            'fin' => 'required|date_format:H:i|after:debut',
            'type_seance' => 'required|in:cours,td,tp',
            'id_salle' => 'required|exists:salles,id_salle',
            'id_module' => 'required|exists:modules,id_module',
            'id_groupe' => 'required|exists:groupes,id_groupe',
            'user_id' => 'required|exists:users,id'
        ]);

        $seance = Seance::create($validated);

        return response()->json([
            'data' => $seance->load(['module', 'salle', 'groupe', 'enseignant', 'filiere', 'semestre'])
        ], Response::HTTP_CREATED);
    }

    public function show(Seance $seance)
    {
        return response()->json([
            'data' => $seance->load(['module', 'salle', 'groupe', 'enseignant', 'filiere', 'semestre'])
        ], Response::HTTP_OK);
    }

    public function update(Request $request, Seance $seance)
    {
        $validated = $request->validate([
            'jour' => 'sometimes|string',
            'debut' => 'sometimes|date_format:H:i',
            'fin' => 'sometimes|date_format:H:i|after:debut',
            'type_seance' => 'sometimes|in:cours,td,tp',
            'id_salle' => 'sometimes|exists:salles,id_salle',
            'user_id' => 'sometimes|exists:users,id'
        ]);

        $seance->update($validated);

        return response()->json([
            'data' => $seance->load(['module', 'salle', 'groupe', 'enseignant', 'filiere', 'semestre'])
        ], Response::HTTP_OK);
    }

    public function destroy(Seance $seance)
    {
        $seance->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}