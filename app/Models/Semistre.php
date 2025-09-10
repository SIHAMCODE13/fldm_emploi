<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semistre extends Model
{
    use HasFactory;
    protected $table = 'semistres'; // Spécifiez explicitement le nom de la table

    protected $primaryKey = 'id_semestre';
    protected $fillable = ['nom_semestre'];

    public function groupes()
    {
        return $this->hasMany(Groupe::class, 'id_semestre');
    }
        public function modules()
    {
        return $this->hasMany(Module::class, 'id_semestre');
    }
}