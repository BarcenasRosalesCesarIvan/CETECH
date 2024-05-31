<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    public function materiaPlanEstudios()
    {
        return $this->belongsToMany(MateriaPlanEstudio::class, 'materia_plan_estudios', 'materia_id', 'materia_plan_estudio_id');
    }

    public function planesEstudio()
    {
        return $this->belongsToMany(PlanEstudio::class, 'materia_plan_estudios', 'plan_estudio_id', 'materia_plan_estudio_id');
    }

    public function grupos()
    {
        return $this->belongsToMany(Grupo::class);
    }


}
