<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\{
    HomeController,
    ModuleController,
    DepartementController,
    FiliereController,
    SalleController,
    SeanceController,
    EmploiController,
    EnseignantController,
    ProfileController,
    AdminController,
    RattrapageController
};
use App\Models\Groupe;

Auth::routes([
    'register' => false,
    'verify' => false
]);

/*------------------------------------------
| Routes Publiques
|------------------------------------------*/
Route::view('/', 'welcome')->name('welcome');

Route::prefix('emplois')->name('emplois.')->group(function() {
    Route::get('/consulter1', [EmploiController::class, 'consulter1'])->name('consulter1');
    Route::post('/rechercher1', [EmploiController::class, 'rechercher1'])->name('rechercher1');
});

/*------------------------------------------
| Routes API Publiques (pour les groupes)
|------------------------------------------*/
Route::prefix('api')->group(function () {
    Route::get('/groupes', function(Request $request) {
        $filiereId = $request->query('filiere_id');
        $groupes = Groupe::where('id_filiere', $filiereId)->get();
        return response()->json($groupes);
    });
});

/*------------------------------------------
| Routes Authentifiées
|------------------------------------------*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', fn() => redirect()->route('home'));

    // Déconnexion
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    // Gestion du profil utilisateur
    Route::prefix('profile')->name('profile.')->group(function() {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('update.password');
    });

    /*------------------------------------------
    | Gestion des Emplois du Temps
    |------------------------------------------*/
    Route::prefix('emplois')->name('emplois.')->group(function() {
            Route::get('/', [EmploiController::class, 'index'])->middleware('can:admin')->name('index');      
               Route::get('/consulter', [EmploiController::class, 'consulter'])->name('consulter');
        Route::get('/ajouter', [EmploiController::class, 'ajouter'])->name('ajouter');

        Route::get('/gerer', [EmploiController::class, 'gerer'])->name('gerer');
        Route::get('/ajouter', [EmploiController::class, 'ajouter'])->name('ajouter');
        Route::post('/store', [EmploiController::class, 'store'])->name('store');
        Route::get('/importer', [EmploiController::class, 'importer'])->name('importer');
        Route::post('/import', [EmploiController::class, 'import'])->name('import');
        Route::get('/generer', [EmploiController::class, 'generer'])->name('generer');
        Route::delete('/{id}', [EmploiController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/edit', [EmploiController::class, 'edit'])->name('edit');
        Route::put('/{id}', [EmploiController::class, 'update'])->name('update');
        Route::post('/rechercher', [EmploiController::class, 'rechercher'])->name('rechercher');

        Route::post('/exporter', [EmploiController::class, 'exporter'])->name('exporter');
    });

    // Routes admin seulement
    Route::middleware(['can:admin'])->group(function() {
        Route::get('/gerer', [EmploiController::class, 'gerer'])->name('gerer');
        Route::get('/ajouter', [EmploiController::class, 'ajouter'])->name('ajouter');
        Route::post('/store', [EmploiController::class, 'store'])->name('store');
        Route::get('/importer', [EmploiController::class, 'importer'])->name('importer');
        Route::post('/import', [EmploiController::class, 'import'])->name('import');
        Route::get('/generer', [EmploiController::class, 'generer'])->name('generer');
        Route::delete('/{id}', [EmploiController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/edit', [EmploiController::class, 'edit'])->name('edit');
        Route::put('/{id}', [EmploiController::class, 'update'])->name('update');
    });

    /*------------------------------------------
    | Administration (sans prefix admin)
    |------------------------------------------*/
    Route::middleware(['can:admin'])->group(function () {
        // Filières
        Route::resource('filieres', FiliereController::class)->except(['show'])->names('filieres');

        // Départements
        Route::resource('departements', DepartementController::class)->except(['show'])->names('departements');
        Route::get('departements/search', [DepartementController::class, 'search'])->name('departements.search');

        // Salles
        Route::resource('salles', SalleController::class)->except(['show'])->names('salles');

        // Séances
        // Route::resource('seances', SeanceController::class)->except(['show'])->names('seances');

        // Modules
        Route::resource('modules', ModuleController::class)->except(['show'])->names('modules');

        // Enseignants
        Route::resource('enseignants', EnseignantController::class)->except(['show'])->names('enseignants');

        // Routes pour l'administration des déclarations et rattrapages
        Route::prefix('admin')->name('admin.')->group(function() {
            Route::get('/declarations', [AdminController::class, 'declarations'])->name('declarations');
            Route::post('/declaration/{id}/update', [AdminController::class, 'updateDeclaration'])->name('declaration.update');

            Route::get('/rattrapages', [AdminController::class, 'rattrapages'])->name('rattrapages');
            Route::post('/rattrapage/{id}/update', [AdminController::class, 'updateRattrapage'])->name('rattrapage.update');

            Route::post('/notification/{id}/read', [AdminController::class, 'markNotificationAsRead'])->name('notification.read');
        });
    });

    /*------------------------------------------
    | Espace Enseignant
    |------------------------------------------*/
    Route::prefix('enseignant')
        ->middleware(['can:enseignant'])
        ->name('enseignant.')
        ->group(function () {
            Route::get('/dashboard', [EnseignantController::class, 'dashboard'])->name('dashboard');

            // Emploi du temps
            Route::get('/emplois-temps', [EnseignantController::class, 'emploisTemps'])->name('emplois-temps');
            Route::get('/emplois-temps/download', [EnseignantController::class, 'downloadEmploisTemps'])->name('emplois-temps.download');

            // Historique des non-disponibilités
            Route::get('/historique', [EnseignantController::class, 'historique'])->name('historique');

            // Profile
            Route::put('/update-profile', [EnseignantController::class, 'updateProfile'])->name('update-profile');

            // Déclarations de non-disponibilité
            Route::get('/declaration', [EnseignantController::class, 'declaration'])->name('declaration');
            Route::post('/declaration/store', [EnseignantController::class, 'storeDeclaration'])->name('declaration.store');
            Route::get('/declaration/{id}/edit', [EnseignantController::class, 'editDeclaration'])->name('declaration.edit');
            Route::put('/declaration/{id}/update', [EnseignantController::class, 'updateDeclaration'])->name('declaration.update');
            Route::delete('/declaration/{id}/delete', [EnseignantController::class, 'destroyDeclaration'])->name('declaration.delete');

            // Rattrapages
            Route::get('/rattrapage', [EnseignantController::class, 'rattrapage'])->name('rattrapage');
            Route::post('/rattrapage/store', [EnseignantController::class, 'storeRattrapage'])->name('rattrapage.store');
            Route::get('/rattrapage/historique', [EnseignantController::class, 'historiqueRattrapage'])->name('rattrapage.historique');
            Route::get('/rattrapage/edit/{id}', [EnseignantController::class, 'editRattrapage'])->name('rattrapage.edit');
            Route::put('/rattrapage/update/{id}', [EnseignantController::class, 'updateRattrapage'])->name('rattrapage.update');
            Route::delete('/rattrapage/delete/{id}', [EnseignantController::class, 'destroyRattrapage'])->name('rattrapage.delete');

            // Notifications
            Route::get('/notification/{id}/read', [EnseignantController::class, 'markNotificationAsRead'])->name('notification.read');
            Route::post('/notification/{id}/read', [EnseignantController::class, 'markNotificationAsRead'])->name('notification.read.post');
        });
});

/*------------------------------------------
| Routes API (protégées)
|------------------------------------------*/
Route::prefix('api')->middleware('auth')->group(function () {
    Route::get('/salles-disponibles', [SalleController::class, 'apiDisponibilite']);

    Route::get('/notifications/count', function(Request $request) {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }
        $count = Auth::user()->unreadNotifications->count();
        return response()->json(['count' => $count]);
    })->name('api.notifications.count');
});

