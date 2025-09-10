<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use App\Models\Seance;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SalleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin');
    }

    /**
     * Affiche la liste des salles avec recherche et pagination
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $salles = Salle::when($search, function($query) use ($search) {
                $query->where('nom_salle', 'like', "%$search%")
                      ->orWhere('capacite', 'like', "%$search%");
            })
            ->orderBy('nom_salle')
            ->paginate(10)
            ->withQueryString();

        return view('salles.index', compact('salles'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $types = ['Amphithéâtre', 'Salle de cours', 'Laboratoire', 'Salle informatique', 'Salle de réunion'];
        return view('salles.create', compact('types'));
    }

    /**
     * Enregistre une nouvelle salle
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_salle' => 'required|string|max:50|unique:salles',
            'capacite' => 'required|integer|min:1|max:500',
            'disponibilite' => 'required|boolean',
            'description' => 'nullable|string|max:255'
        ]);

        Salle::create($validated);

        return redirect()->route('salles.index')
            ->with('success', 'Salle créée avec succès');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit($id_salle)
    {
        $salle = Salle::findOrFail($id_salle);
        $types = ['Amphithéâtre', 'Salle de cours', 'Laboratoire', 'Salle informatique', 'Salle de réunion'];
        return view('salles.edit', compact('salle', 'types'));
    }

    /**
     * Met à jour une salle existante
     */
    public function update(Request $request, $id_salle)
    {
        $salle = Salle::findOrFail($id_salle);
        
        $validated = $request->validate([
            'nom_salle' => [
                'required',
                'string',
                'max:50',
                Rule::unique('salles')->ignore($salle->id_salle, 'id_salle')
            ],
            'capacite' => 'required|integer|min:1|max:500',
            'disponibilite' => 'required|boolean',
            'description' => 'nullable|string|max:255'
        ]);

        $salle->update($validated);

        return redirect()->route('salles.index')
            ->with('success', 'Salle mise à jour avec succès');
    }

    /**
     * Supprime une salle après vérification des dépendances
     */
    public function destroy($id_salle)
    {
        $salle = Salle::findOrFail($id_salle);

        if (Seance::where('id_salle', $salle->id_salle)->exists()) {
            return back()->with('error', 
                'Impossible de supprimer : la salle est utilisée dans des séances planifiées');
        }

        $salle->delete();

        return redirect()->route('salles.index')
            ->with('success', 'Salle supprimée avec succès');
    }

    public function apiDisponibilite()
{
    $salles = Salle::where('disponibilite', true)
        ->select('id_salle', 'nom_salle', 'capacite', 'disponibilite')
        ->get();

    return response()->json([
        'data' => $salles
    ]);
}
}