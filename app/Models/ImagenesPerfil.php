<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenesPerfil extends Model
{
    protected $table = 'imagenes_perfiles';

    use HasFactory;

    public function perfil()
    {
        return $this->belongsTo(\App\Models\Perfil::class, 'perfil_id', 'id');
    }
}
