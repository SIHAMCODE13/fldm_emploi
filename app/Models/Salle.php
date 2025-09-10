<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_salle';
    protected $fillable = ['nom_salle', 'capacite', 'disponibilite'];
    
    // Add this line to disable timestamps
    public $timestamps = true;

    public function seances()
    {
        return $this->hasMany(Seance::class, 'id_salle');
    }
}