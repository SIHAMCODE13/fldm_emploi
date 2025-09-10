<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Filiere;
use App\Models\Semistre;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Module::query();

        if ($search) {
            $query->where('nom_module', 'like', "%$search%");
        }

        $modules = $query->with(['filiere', 'semestre'])->paginate(10);
        return view('modules.index', compact('modules'));
    }

    public function create()
    {
        $filieres = Filiere::all();
        $semestres = Semistre::all();
        return view('modules.create', compact('filieres', 'semestres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_module' => 'required|string|max:255|unique:modules,nom_module',
            'id_filiere' => 'required|exists:filieres,id_filiere',
            'id_semestre' => 'required|exists:semistres,id_semestre',
        ]);

        Module::create($validated);
        return redirect()->route('modules.index')->with('success', 'Module ajouté avec succès.');
    }

    public function edit($id_module)
    {
        $module = Module::findOrFail($id_module);
        $filieres = Filiere::all();
        $semestres = Semistre::all();
        return view('modules.edit', compact('module', 'filieres', 'semestres'));
    }

    public function update(Request $request, $id_module)
    {
        $module = Module::findOrFail($id_module);

        $validated = $request->validate([
            'nom_module' => 'required|string|max:255|unique:modules,nom_module,'.$module->id_module.',id_module',
            'id_filiere' => 'required|exists:filieres,id_filiere',
            'id_semestre' => 'required|exists:semistres,id_semestre',
        ]);

        $module->update($validated);

        return redirect()->route('modules.index')
                     ->with('success', ' Module modifié avec succès');    }

    public function destroy($id_module)
    {
        $module = Module::findOrFail($id_module);

        if ($module->seances()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer ce module car il a des séances associées.');
        }

        if ($module->groupes()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer ce module car il est associé à des groupes.');
        }

        $module->delete();
        return redirect()->route('modules.index')->with('success', 'Module supprimé avec succès.');
    }
}