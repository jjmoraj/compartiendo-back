<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenesVivienda extends Model
{
    use HasFactory;

    public function vivienda(){
        return $this->belongsTo(\App\Models\Vivienda::class,'vivienda_id','id');
    }
}
