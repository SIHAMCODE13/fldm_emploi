<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiliereCycle extends Model
{
    use HasFactory;

    protected $table = 'filier_cycles';
    public $incrementing = false;
    protected $fillable = ['id_filiere', 'id_cycle'];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'id_filiere');
    }

    public function cycle()
    {
        return $this->belongsTo(Cycle::class, 'id_cycle');
    }
}