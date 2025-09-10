<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcours extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_parcours';
    protected $fillable = ['code_parcours', 'parcours', 'parcours_ar', 'id_filiere'];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'id_filiere');
    }
}