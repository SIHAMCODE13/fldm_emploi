<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JourFerie extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jour_ferie';
    protected $fillable = ['date_ferie', 'type', 'description'];

    public function seances()
    {
        return $this->hasMany(Seance::class, 'id_jour_ferie');
    }
}