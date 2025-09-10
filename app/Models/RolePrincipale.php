<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePrincipale extends Model
{
    use HasFactory;

    protected $table = 'role_principale';
    protected $primaryKey = ['id_role', 'id_user'];
    public $incrementing = false;
    protected $fillable = ['id_role', 'id_user', 'role_principale'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}