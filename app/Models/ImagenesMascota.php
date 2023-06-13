<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenesMascota extends Model
{
    use HasFactory;

    public function mascota(){
        return $this->belongsTo(\App\Models\Mascotas::class,'mascota_id','id');
    }
}
