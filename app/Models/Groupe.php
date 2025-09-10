<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_groupe'; // Assurez-vous que c'est correct
    protected $table = 'groupes';
    protected $fillable = ['nom_groupe']; // ou 'nom_groupe' selon ton champ réel


    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'id_filiere');
    }

// Dans Module.php
public function semestre()
{
    return $this->belongsTo(Semistre::class, 'id_semestre');
}
    public function users()
    {
        return $this->belongsToMany(User::class, 'groupe_users', 'id_groupe', 'id_users')
                    ->withPivot('annee_scolaire');
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'groupe_modele', 'id_groupe', 'id_module');
    }

    public function seances()
    {
        return $this->hasMany(Seance::class, 'id_groupe');
    }

}
