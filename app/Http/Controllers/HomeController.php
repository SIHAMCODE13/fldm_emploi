<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Filiere;
use App\Models\Salle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Affiche le tableau de bord principal
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Durée de mise en cache (en minutes)
        $cacheDuration = 30; // 30 minutes
        
        // Récupération des données avec cache
        $stats = Cache::remember('dashboard_stats', $cacheDuration, function () {
            return [
                'departements' => Departement::count(),
                'filieres'     => Filiere::count(),
                'salles'       => Salle::count(),
                'enseignants'  => User::whereHas('role', function ($query) {
                    $query->where('nom', 'enseignant');
                })->count()
            ];
        });

        // Récupération des activités récentes avec cache
        $activities = Cache::remember('dashboard_activities', $cacheDuration, function () {
            $activities = collect();

            // Recent filieres (uniquement celles avec created_at non null)
            Filiere::whereNotNull('created_at')->latest()->take(3)->get()->each(function ($filiere) use ($activities) {
                // Vérifier si created_at est un objet Carbon, sinon le convertir
                $time = $filiere->created_at instanceof \Carbon\Carbon 
                    ? $filiere->created_at->diffForHumans() 
                    : Carbon::parse($filiere->created_at)->diffForHumans();
                
                $activities->push([
                    'icon' => 'fa-circle-plus text-success',
                    'title' => 'Nouvelle filière ajoutée',
                    'description' => $filiere->nom_filiere,
                    'time' => $time,
                    'link' => route('filieres.index')
                ]);
            });

            // Recent enseignants (uniquement ceux avec created_at non null)
            User::whereHas('role', function ($query) {
                $query->where('nom', 'enseignant');
            })->whereNotNull('created_at')->latest()->take(3)->get()->each(function ($enseignant) use ($activities) {
                // Vérifier si created_at est un objet Carbon, sinon le convertir
                $time = $enseignant->created_at instanceof \Carbon\Carbon 
                    ? $enseignant->created_at->diffForHumans() 
                    : Carbon::parse($enseignant->created_at)->diffForHumans();
                
                $activities->push([
                    'icon' => 'fa-user-check text-primary',
                    'title' => 'Nouvel enseignant',
                    'description' => $enseignant->name,
                    'time' => $time,
                    'link' => route('enseignants.index')
                ]);
            });

            // Recent departements (uniquement ceux avec created_at non null)
            Departement::whereNotNull('created_at')->latest()->take(3)->get()->each(function ($departement) use ($activities) {
                // Vérifier si created_at est un objet Carbon, sinon le convertir
                $time = $departement->created_at instanceof \Carbon\Carbon 
                    ? $departement->created_at->diffForHumans() 
                    : Carbon::parse($departement->created_at)->diffForHumans();
                
                $activities->push([
                    'icon' => 'fa-building text-info',
                    'title' => 'Nouveau département ajouté',
                    'description' => $departement->nom_departement,
                    'time' => $time,
                    'link' => route('departements.index')
                ]);
            });

            // Recent salles (uniquement celles avec created_at non null)
            Salle::whereNotNull('created_at')->latest()->take(3)->get()->each(function ($salle) use ($activities) {
                // Vérifier si created_at est un objet Carbon, sinon le convertir
                $time = $salle->created_at instanceof \Carbon\Carbon 
                    ? $salle->created_at->diffForHumans() 
                    : Carbon::parse($salle->created_at)->diffForHumans();
                
                $activities->push([
                    'icon' => 'fa-door-open text-warning',
                    'title' => 'Nouvelle salle ajoutée',
                    'description' => $salle->nom_salle,
                    'time' => $time,
                    'link' => route('salles.index')
                ]);
            });

            // Sort by time and limit to 5
            return $activities->sortByDesc('time')->take(5);
        });

        return view('home', array_merge($stats, ['activities' => $activities]));
    }

    /**
     * Version alternative avec eager loading et optimisation des requêtes
     * (Utile si vous avez besoin d'autres données plus tard)
     */
    public function indexAlternative()
    {
        // Chargement des données en une seule requête avec withCount
        $data = [
            'departements' => Departement::count(),
            'filieres'     => Filiere::count(),
            'salles'       => Salle::count(),
            'enseignants' => User::whereHas('role', function($q) {
                $q->where('nom', 'enseignant');
            })->count(),
            
            // Données supplémentaires potentielles
            'recent_departements' => Departement::latest()->take(5)->get(),
            'active_filieres'     => Filiere::withCount('etudiants')
                                        ->orderBy('etudiants_count', 'desc')
                                        ->take(5)
                                        ->get()
        ];

        return view('home', $data);
    }

    /**
     * Version pour API (si nécessaire)
     */
    public function getDashboardStats()
    {
        return response()->json([
            'departements' => Departement::count(),
            'filieres'     => Filiere::count(),
            'salles'       => Salle::count(),
            'enseignants'  => User::whereHas('role', function($q) {
                $q->where('nom', 'enseignant');
            })->count()
        ]);
    }
}