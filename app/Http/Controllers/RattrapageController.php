<?php

namespace App\Http\Controllers;

use App\Models\Rattrapage;
use App\Models\User;
use App\Notifications\RattrapageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RattrapageController extends Controller
{
    public function declaration()
    {
        $user = Auth::user();
        
        if (!$user || $user->id_role != 2) {
            return redirect('/login')->with('error', 'Accès non autorisé');
        }
        
        return view('enseignants.rattrapage', compact('user'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'periode' => 'required|in:8:30h-10:30h,10:30h-12:30h,14:30h-16:30h,16:30h-18:30h',
            'type_seance' => 'required|in:Cours,TD,TP',
            'module' => 'required|string|max:255',
            'groupe' => 'required|string|max:255',
        ]);

        // Vérifier les conflits de dates
        $date = Carbon::parse($request->date);

        // Vérifier les rattrapages existants pour cette période
        $existingRattrapage = Rattrapage::where('id_role', $user->id)
            ->where('date', $date)
            ->where('periode', $request->periode)
            ->where('statut', '!=', 'rejete')
            ->first();

        if ($existingRattrapage) {
            return redirect()->back()
                ->with('error', 'Un rattrapage existe déjà pour cette période.')
                ->withInput();
        }

        // Créer le rattrapage
        $rattrapage = Rattrapage::create([
            'enseignant_id' => $user->id,
            'date' => $request->date,
            'periode' => $request->periode,
            'type_seance' => $request->type_seance,
            'module' => $request->module,
            'groupe' => $request->groupe,
            'statut' => 'en_attente',
        ]);

        // Notifier les administrateurs
        $admins = User::where('id_role', 1)->get();
        foreach ($admins as $admin) {
            $admin->notify(new RattrapageNotification(
                'Nouvelle demande de rattrapage de ' . $user->name . ' pour le ' . $date->format('d/m/Y'),
                $rattrapage->id,
                'admin'
            ));
        }

        return redirect()->route('enseignant.rattrapage.historique')
            ->with('success', 'Demande de rattrapage soumise avec succès!');
    }

    public function historique(Request $request)
    {
        $user = auth()->user();
        if ($user->id_role !== 2) {
            abort(403, 'Accès refusé.');
        }

        $search = $request->input('search');
        $filter = $request->input('filter', 'tous');
        
        $rattrapages = Rattrapage::where('id_role', $user->id)
            ->when($search, function ($query, $search) {
                return $query->where('module', 'like', "%{$search}%")
                             ->orWhere('groupe', 'like', "%{$search}%")
                             ->orWhere('statut', 'like', "%{$search}%");
            })
            ->when($filter !== 'tous', function ($query) use ($filter) {
                return $query->where('statut', $filter);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('enseignants.historique-rattrapage', compact('rattrapages'));
    }
}