<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfiles';
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function mascota()
    {
        return $this->hasOne(\App\Models\Mascota::class, 'perfil_id', 'id');
    }
    public function vivienda()
    {
        return $this->hasOne(\App\Models\Vivienda::class, 'perfil_id', 'id');
    }

    public function imagenes()
    {
        return $this->hasMany(
            \App\Models\ImagenesPerfil::class,
            'perfil_id',
            'id'
        );
    }
}
