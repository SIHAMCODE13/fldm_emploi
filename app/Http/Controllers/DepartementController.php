<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\User;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index()
    {
        $departements = Departement::all(); // Supprime with('responsable')
        return view('departements.index', compact('departements'));
    }

    public function create()
    {
        $professors = User::where('id_role', 2)->get(); // Récupère les professeurs
        return view('departements.create', compact('professors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'responsable' => 'required|string|max:100', // Conserve la validation texte
        ]);

        Departement::create([
            'nom' => $request->nom,
            'responsable' => $request->responsable, // Enregistre le nom du professeur
        ]);

        return redirect()->route('departements.index')->with('success', 'Département créé avec succès.');
    }

    public function edit($id)
    {
        $departement = Departement::findOrFail($id);
        $professors = User::where('id_role', 2)->get(); // Récupère les professeurs
        return view('departements.edit', compact('departement', 'professors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'responsable' => 'required|string|max:100',
        ]);

        $departement = Departement::findOrFail($id);
        $departement->update([
            'nom' => $request->nom,
            'responsable' => $request->responsable,
        ]);

        return redirect()->route('departements.index')->with('success', 'Département mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $departement = Departement::findOrFail($id);
        $departement->delete();
        return redirect()->route('departements.index')->with('success', 'Département supprimé avec succès.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $departements = Departement::where('nom', 'like', "%$search%")
            ->orWhere('responsable', 'like', "%$search%")
            ->get();
        return view('departements.index', compact('departements'));
    }
}