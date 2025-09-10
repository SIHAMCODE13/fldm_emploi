<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rattrapage extends Model
{
    use HasFactory;
        protected $primaryKey = 'id'; // Ou 'id_rattrapage' si c'est le nom

    protected $fillable = [
        'user_id', // ← Assurez-vous que ce champ est présent
        'date',
        'periode',
        'type_seance',
        'module',
        'groupe',
        'statut',
        'salle_attribuee',
        'raison_refus'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function enseignant()
    {
        return $this->belongsTo(User::class, 'user_id')->where('id_role', 2);
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class, 'salle_attribuee', 'id_salle');
    }

    public function isEnAttente()
    {
        return $this->statut === 'en_attente';
    }

    public function isApprouve()
    {
        return $this->statut === 'approuve';
    }

    public function isRejete()
    {
        return $this->statut === 'rejete';
    }
}