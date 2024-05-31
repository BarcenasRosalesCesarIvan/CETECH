<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    protected $table = 'salones';
    
    // Indicar a Laravel que no maneje las marcas de tiempo
    public $timestamps = false;

    // Un salon pertenece a un edificio
    public function edificio() {
        return $this->belongsTo(Edificio::class);
    }


}