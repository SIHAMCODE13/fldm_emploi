<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupeUser extends Model
{
    use HasFactory;

    protected $table = 'groupe_users';
    public $incrementing = false;
    protected $fillable = ['annee_scolaire', 'id_groupe', 'id_users'];

    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'id_groupe');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}