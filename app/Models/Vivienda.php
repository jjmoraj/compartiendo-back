<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vivienda extends Model
{
    use HasFactory;

    public function perfil(){
        return $this->hasOne(\App\Models\Perfil::class,'perfil_id','id');
    }

    public function imagenes(){
        return $this->hasMany(\App\Models\ImagenesVivienda::class,'vivienda_id','id');
    }
}
