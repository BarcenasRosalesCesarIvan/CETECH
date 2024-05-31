<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPlanEstudio extends Model
{
    use HasFactory;

    protected $table = 'materia_plan_estudios';

    public function materias()
    {
        return $this->belongsToMany(Materia::class, 'materia_plan_estudios', 'materia_id', 'materia_plan_estudio_id');
    }

    public function planesEstudio()
    {
        return $this->belongsToMany(PlanEstudio::class, 'materia_plan_estudios', 'plan_estudio_id', 'materia_plan_estudio_id');
    }
}
