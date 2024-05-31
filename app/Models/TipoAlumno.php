<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Docente;
use App\Models\Alumno;

class TipoAlumno extends Model
{
    use HasFactory;

    protected $table = 'tipos_alumnos';

    protected $fillable = [
        'nombre_tipo',
    ];

    public function alumnos(){
        return $this -> hasMany(Alumno::class,'tipo_de_alumno_id','id');
    }
}
