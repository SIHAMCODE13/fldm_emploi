<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_module';
    public $timestamps = true;

    protected $fillable = ['nom_module', 'id_filiere', 'id_semestre'];

    // Configuration pour Laravel 12
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];


    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'id_filiere');
    }

    public function groupes()
    {
        return $this->belongsToMany(Groupe::class, 'groupe_modele', 'id_module', 'id_groupe');
    }

    public function seances()
    {
        return $this->hasMany(Seance::class, 'id_module');
    }

    public function semestre()
    {
        return $this->belongsTo(Semistre::class, 'id_semestre');
    }
}