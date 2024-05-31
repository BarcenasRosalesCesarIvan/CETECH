<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;


    public function plan()
    {
        return $this->belongsTo(PlanEstudio::class, 'id'); // Asegúrate de que 'plan_id' es la clave foránea correcta
    }
    
    
    // Tipos materias
    public function materia() {
        return $this->belongsTo(Materia::class,'id');
    }
   
    public function periodo()
    {
        return $this->belongsTo(Periodo::class,'id');
    }

    // Docentes
    public function docente() {
        return $this->belongsTo(Docente::class,'id');
    }
}
