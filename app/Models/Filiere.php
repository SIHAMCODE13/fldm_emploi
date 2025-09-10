<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_filiere';
    protected $fillable = ['nom_filiere', 'id_departement'];
    
    // Add this line to disable timestamps
    public $timestamps = true;

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement');
    }

    public function modules()
    {
        return $this->hasMany(Module::class, 'id_filiere');
    }

    public function groupes()
    {
        return $this->hasMany(Groupe::class, 'id_filiere');
    }

    public function parcours()
    {
        return $this->hasMany(Parcours::class, 'id_filiere');
    }

    public function cycles()
    {
        return $this->belongsToMany(Cycle::class, 'filier_cycles', 'id_filiere', 'id_cycle');
    }
}