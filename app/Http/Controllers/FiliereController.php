<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Departement;
use App\Models\Module;
use App\Models\Groupe;
use App\Models\Parcours;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FiliereController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin');
    }

    /**
     * Affiche la liste des filières avec recherche et pagination
     */
    public function index(Request $request)
    {
        try {
            $search = $request->input('search');
            
            $filieres = Filiere::with('departement')
                ->when($search, function($query) use ($search) {
                    $query->where('nom_filiere', 'like', "%$search%")
                          ->orWhereHas('departement', function($q) use ($search) {
                              $q->where('nom', 'like', "%$search%");
                          });
                })
                ->orderBy('nom_filiere')
                ->paginate(10)
                ->withQueryString();

            return view('filieres.index', compact('filieres'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $departements = Departement::orderBy('nom')->get();
        return view('filieres.create', compact('departements'));
    }

    /**
     * Enregistre une nouvelle filière
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_filiere' => [
                'required',
                'string',
                'max:100',
                Rule::unique('filieres')->where(function ($query) use ($request) {
                    return $query->where('id_departement', $request->id_departement);
                })
            ],
            'id_departement' => 'required|exists:departements,id_departement',
        ], [
            'nom_filiere.unique' => 'Une filière avec ce nom existe déjà dans ce département'
        ]);

        Filiere::create($validated);

        return redirect()->route('filieres.index')
            ->with('success', 'Filière créée avec succès');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit($id_filiere)
    {
        $filiere = Filiere::findOrFail($id_filiere);
        $departements = Departement::orderBy('nom')->get();
        
        return view('filieres.edit', compact('filiere', 'departements'));
    }

    /**
     * Met à jour une filière existante
     */
    public function update(Request $request, $id_filiere)
    {
        $filiere = Filiere::findOrFail($id_filiere);

        $validated = $request->validate([
            'nom_filiere' => [
                'required',
                'string',
                'max:100',
                Rule::unique('filieres')
                    ->where(function ($query) use ($request) {
                        return $query->where('id_departement', $request->id_departement);
                    })
                    ->ignore($filiere->id_filiere, 'id_filiere')
            ],
            'id_departement' => 'required|exists:departements,id_departement',
        ], [
            'nom_filiere.unique' => 'Une filière avec ce nom existe déjà dans ce département'
        ]);

        $filiere->update($validated);

        return redirect()->route('filieres.index')
            ->with('success', 'Filière mise à jour avec succès');
    }

    /**
     * Supprime une filière après vérification des dépendances
     */
    public function destroy($id_filiere)
    {
        $filiere = Filiere::findOrFail($id_filiere);

        $dependencies = [
            'Modules' => Module::where('id_filiere', $id_filiere)->exists(),
            'Groupes' => Groupe::where('id_filiere', $id_filiere)->exists(),
            'Parcours' => Parcours::where('id_filiere', $id_filiere)->exists()
        ];

        if (in_array(true, $dependencies)) {
            $message = 'Impossible de supprimer : éléments associés existants (';
            $message .= implode(', ', array_keys(array_filter($dependencies)));
            $message .= ')';
            
            return back()->with('error', $message);
        }

        $filiere->delete();
        
        return redirect()->route('filieres.index')
            ->with('success', 'Filière supprimée avec succès');
    }
}