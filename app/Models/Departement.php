<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_departement';
    protected $fillable = ['nom', 'responsable'];
    public $timestamps = true; // Add this line

    public function filieres()
    {
        return $this->hasMany(Filiere::class, 'id_departement');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'departement_id');
    }
}