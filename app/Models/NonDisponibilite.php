<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // AJOUTEZ CETTE LIGNE



class NonDisponibilite extends Model
{
     use HasFactory; // AJOUTEZ CETTE LIGNE
    protected $table = 'non_disponibilites';
    
    protected $fillable = [
        'enseignant_id',
        'date_debut',
        'date_fin',
        'type_periode',
        'periode',
        'raison',
        'statut'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    public function enseignant()
    {
        return $this->belongsTo(User::class, 'enseignant_id');
    }

    public function isJourneeComplete()
    {
        return $this->type_periode === 'journee';
    }

    public function isPeriodeSpecifique()
    {
        return $this->type_periode === 'periode';
    }
}