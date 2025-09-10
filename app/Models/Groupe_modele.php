<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe_modele extends Model
{
    use HasFactory;

    protected $table = 'groupe_modele';
    public $incrementing = false;
    protected $fillable = ['id_module', 'id_groupe'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'id_module');
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'id_groupe');
    }
}