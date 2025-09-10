<?php

namespace App\Http\Controllers;

use App\Models\NonDisponibilite;
use App\Models\Rattrapage;
use App\Models\User;
use App\Models\Salle; // ✅ Import manquant
use App\Notifications\DeclarationNotification;
use App\Notifications\RattrapageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function declarations()
    {
        $declarations = NonDisponibilite::with('enseignant')
            ->where('statut', 'en_attente')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.declarations', compact('declarations'));
    }

    public function rattrapages()
    {
        $rattrapages = Rattrapage::with('enseignant')
            ->where('statut', 'en_attente')
            ->orderBy('created_at', 'desc')
            ->get();

        // ✅ Charger aussi les salles disponibles
        $salles = Salle::where('disponibilite', 1)->get();

        return view('admin.rattrapages', compact('rattrapages', 'salles'));
    }

    public function updateDeclaration(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:approuve,rejete'
        ]);

        $declaration = NonDisponibilite::findOrFail($id);
        $ancienStatut = $declaration->statut;
        $declaration->statut = $request->statut;
        $declaration->save();

        // Envoyer une notification à l'enseignant
        $enseignant = User::find($declaration->enseignant_id);

        if ($enseignant) {
            if ($request->statut == 'approuve') {
                $message = 'Votre déclaration de non-disponibilité du ' .
                          $declaration->date_debut->format('d/m/Y') .
                          ' a été approuvée avec succès.';
            } else {
                $message = 'Votre déclaration de non-disponibilité du ' .
                          $declaration->date_debut->format('d/m/Y') .
                          ' a été rejetée.';
            }

            $enseignant->notify(new DeclarationNotification($message, $declaration->id));

            Log::info('Notification envoyée à l\'enseignant', [
                'enseignant_id' => $enseignant->id,
                'enseignant_name' => $enseignant->name,
                'declaration_id' => $declaration->id,
                'statut' => $request->statut,
                'message' => $message
            ]);
        } else {
            Log::error('Enseignant non trouvé pour la déclaration', [
                'declaration_id' => $id,
                'enseignant_id' => $declaration->enseignant_id
            ]);
        }

        return redirect()->route('admin.declarations')
            ->with('success', 'Déclaration ' . ($request->statut == 'approuve' ? 'approuvée' : 'rejetée') . ' avec succès.');
    }

    public function updateRattrapage(Request $request, $id)
{
    $request->validate([
        'statut' => 'required|in:approuve,rejete',
        'salle_attribuee' => 'nullable|required_if:statut,approuve|exists:salles,id_salle',
        'raison_refus' => 'nullable|required_if:statut,rejete|string|max:500'
    ]);

    $rattrapage = Rattrapage::findOrFail($id);
    $rattrapage->statut = $request->statut;

    if ($request->statut == 'approuve') {
        $rattrapage->salle_attribuee = $request->salle_attribuee;
        $rattrapage->raison_refus = null;
        
        // Marquer la salle comme occupée si nécessaire
        if ($request->salle_attribuee) {
            $salle = Salle::find($request->salle_attribuee);
            // Vous pouvez ajouter une logique pour gérer la disponibilité des salles ici
        }
    } else {
        $rattrapage->salle_attribuee = null;
        $rattrapage->raison_refus = $request->raison_refus;
    }

    $rattrapage->save();

    // Envoyer une notification à l'enseignant
$enseignant = User::find($rattrapage->user_id);

if ($enseignant) {
    if ($request->statut == 'approuve') {
        $salle = Salle::find($request->salle_attribuee);
        $message = 'Votre demande de rattrapage du ' .
                  $rattrapage->date->format('d/m/Y') .
                  ' a été approuvée. Salle attribuée: ' . ($salle ? $salle->nom_salle : 'Non spécifiée');
    } else {
        $message = 'Votre demande de rattrapage du ' .
                  $rattrapage->date->format('d/m/Y') .
                  ' a été rejetée. Raison: ' . $request->raison_refus;
    }

   
        $enseignant->notify(new RattrapageNotification($message, $rattrapage->id, 'enseignant'));

        Log::info('Notification de rattrapage envoyée à l\'enseignant', [
            'enseignant_id' => $enseignant->id,
            'enseignant_name' => $enseignant->name,
            'rattrapage_id' => $rattrapage->id,
            'statut' => $request->statut,
        ]);
    } else {
        Log::error('Enseignant non trouvé pour le rattrapage', [
            'rattrapage_id' => $id,
            'user_id' => $rattrapage->user_id
        ]);
    }

    return redirect()->route('admin.rattrapages')
        ->with('success', 'Demande de rattrapage ' . ($request->statut == 'approuve' ? 'approuvée' : 'rejetée') . ' avec succès.');
}
public function markNotificationAsRead($id)
{
    $notification = auth()->user()->notifications()->where('id', $id)->first();

    if ($notification) {
        $notification->markAsRead();
        
        // Vérifier le type de notification et rediriger en conséquence
        $data = $notification->data;
        
        // CORRECTION: Vérifier si c'est une notification de rattrapage
        if (isset($data['rattrapage_id'])) {
            // Rediriger vers la page des rattrapages
            return redirect()->route('admin.rattrapages')
                ->with('success', 'Notification marquée comme lue');
        } 
        else if (isset($data['declaration_id'])) {
            // Rediriger vers la page des déclarations
            return redirect()->route('admin.declarations')
                ->with('success', 'Notification marquée comme lue');
        }
    }

    return response()->json(['success' => true]);
}
}
