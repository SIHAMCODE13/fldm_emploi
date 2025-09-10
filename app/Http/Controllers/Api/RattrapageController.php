<?php

namespace App\Http\Controllers\Api;

use App\Models\Rattrapage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RattrapageController extends Controller
{
    public function index()
    {
        $rattrapages = Rattrapage::with(['user', 'salle'])->get();
        
        return response()->json([
            'data' => $rattrapages
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'periode' => 'required|in:matin,apres-midi',
            'type_seance' => 'required|in:rattrapage,examen',
            'module' => 'required|string|max:255',
            'groupe' => 'required|string|max:255',
            'statut' => 'sometimes|in:en_attente,approuve,rejete',
            'salle_attribuee' => 'nullable|exists:salles,id_salle',
            'raison_refus' => 'nullable|string'
        ]);

        $rattrapage = Rattrapage::create($validated);

        return response()->json([
            'data' => $rattrapage->load(['user', 'salle'])
        ], Response::HTTP_CREATED);
    }

    public function show(Rattrapage $rattrapage)
    {
        return response()->json([
            'data' => $rattrapage->load(['user', 'salle'])
        ], Response::HTTP_OK);
    }

    public function update(Request $request, Rattrapage $rattrapage)
    {
        $validated = $request->validate([
            'date' => 'sometimes|date',
            'periode' => 'sometimes|in:matin,apres-midi',
            'statut' => 'sometimes|in:en_attente,approuve,rejete',
            'salle_attribuee' => 'nullable|exists:salles,id_salle',
            'raison_refus' => 'nullable|string'
        ]);

        $rattrapage->update($validated);

        return response()->json([
            'data' => $rattrapage->load(['user', 'salle'])
        ], Response::HTTP_OK);
    }

    public function destroy(Rattrapage $rattrapage)
    {
        $rattrapage->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function approve(Rattrapage $rattrapage)
    {
        $rattrapage->update(['statut' => 'approuve']);

        return response()->json([
            'data' => $rattrapage->load(['user', 'salle'])
        ], Response::HTTP_OK);
    }

    public function reject(Request $request, Rattrapage $rattrapage)
    {
        $validated = $request->validate([
            'raison_refus' => 'required|string'
        ]);

        $rattrapage->update([
            'statut' => 'rejete',
            'raison_refus' => $validated['raison_refus']
        ]);

        return response()->json([
            'data' => $rattrapage->load(['user', 'salle'])
        ], Response::HTTP_OK);
    }
}