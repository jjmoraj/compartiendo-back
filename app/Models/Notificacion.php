<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;
    protected $table = 'notificaciones';

    public function emisores()
    {
        return $this->hasMany(\App\Models\Perfil::class, 'emisor_id', 'id');
    }

    public function receptores()
    {
        return $this->hasMany(\App\Models\Perfil::class, 'receptor_id', 'id');
    }
}
