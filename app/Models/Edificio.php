<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre_edificio',
        'descripcion',
    ];

    // Indicar a Laravel que no maneje las marcas de tiempo
    public $timestamps = false;

    // Un edificio puede tener muchos salones, pero un salon puede tener solo 1 edificio
    public function salones(){
        return $this -> hasMany(Salon::class);
    }
}
