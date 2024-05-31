<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanEstudio extends Model
{
    use HasFactory;
    
    protected $table = 'planes_estudio';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'clave_plan_estudio',
        'carrera',
    ];

    //marcas de tiempo
    public $timestamps = false;
    

    public function especialidades(){
        return $this -> hasMany(Especialidades::class);
    }

    public function alumnos(){
        return $this -> hasMany(Alumnos::class);
    }

    public function materiaPlanEstudios()
    {
        return $this->belongsToMany(MateriaPlanEstudio::class, 'materia_plan_estudios', 'materia_id', 'materia_plan_estudio_id');
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'planEstudio_id'); // Cambio de belongsToMany a hasMany
    }


    // Indicar a Laravel que no maneje las marcas de tiempo


    
}
