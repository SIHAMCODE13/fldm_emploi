<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_role';
    protected $fillable = ['nom', 'permission'];

    public function users()
    {
        return $this->hasMany(User::class, 'id_role');
    }

    public function rolesPrincipales()
    {
        return $this->hasMany(RolePrincipale::class, 'id_role');
    }
}