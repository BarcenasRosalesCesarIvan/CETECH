<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Grupo;
use App\Models\PlanEstudio;
use App\Models\Periodo;
use App\Models\Materia;
use App\Models\Docente;


class GruposMateriasAlumnosController extends Controller
{
    public function visualizaGM(){
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Verificar si el usuario está autenticado
        if ($user) {
            // Obtener los grupos del docente con el ID del usuario
            $result = DB::table('alumnos')->where('user_id', '=', $user->id)->first(); // Usamos first() para obtener solo el primer resultado

            $grupo = DB::table('grupos')->where('planEstudio_id', '=', $result->plan_estudio_id)->get();
           
            
            $docentes = Docente::all();
            $periodos = Periodo::all();
            $planes = PlanEstudio::all();
            $materias = Materia::all();
            
            $grupos = Grupo::all();
            
            // Retornar la vista con los resultados
            return view('Escolares.gruposMateriasAlumnos', compact('result','periodos','planes','materias','grupos','user','grupo','docentes'));
        } else {
            // Si el usuario no está autenticado, redirigir a la página de inicio de sesión
            return redirect()->route('login');
        }
}


}// fin
