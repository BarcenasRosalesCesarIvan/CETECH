<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $table = 'alumnos';
    public $timestamps  = false;
    // condicionales
    // Planes de estudio
    public function planEstudio() {
        return $this->belongsTo(PlanEstudio::class);
    }
    // Estatus
    public function estatus() {
        return $this->belongsTo(Estatus::class);
    }
    // Tipos de alumno
    public function tipo_alumno() {
        return $this->belongsTo(TipoAlumno::class,'id');
    }
    // usuarios
    public function user() {
        return $this->belongsTo(User::class);
    }

}
