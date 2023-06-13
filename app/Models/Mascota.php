<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    public function perfil(){
        return $this->belongsTo(\App\Models\Perfil::class,'perfil_id','id');
    }


    public function imagenes(){
        return $this->hasMany(\App\Models\ImagenesMascota::class,'mascota_id','id');
    }

}
