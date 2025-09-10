<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmploiController; // ← Utilisez EmploiController

Route::prefix('api')->middleware('web')->group(function () {
    // Changez SalleController pour EmploiController
    Route::get('/salles-disponibles', [EmploiController::class, 'apiDisponibilite']);

    Route::get('/notifications/count', function() {
        $count = Auth::check() ? Auth::user()->unreadNotifications->count() : 0;
        return response()->json(['count' => $count]);
    });
});