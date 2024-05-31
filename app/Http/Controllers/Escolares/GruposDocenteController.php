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

class GruposDocenteController extends Controller
{
  public function visualizaGruposDocente(){
    // Obtener el usuario autenticado
    $user = Auth::user();
    

    // Verificar si el usuario está autenticado
    if ($user) {
        // Obtener los grupos del docente con el ID del usuario
        $docente = DB::table('docentes')->where('user_id', '=', $user->id)->first();
        
        $result = DB::table('grupos')->where('docente_id', '=', $docente->id)->get();
        $periodos = Periodo::all();
        $planes = PlanEstudio::all();
        $materias = Materia::all();
        
        $grupos = Grupo::all();
        
        // Retornar la vista con los resultados
        return view('Escolares.gruposDocente', compact('result','periodos','planes','materias','grupos','user'));
    } else {
        // Si el usuario no está autenticado, redirigir a la página de inicio de sesión
        return redirect()->route('login');
    }
}


public function visualizaAlumnos(){
  //retornar variables

 
  // mandar variables a la lista

  // Obtener la clave del plan desde el formulario
  
  $clave = request()->input('txtPlan');
  
  // Verificar si se ha proporcionado la clave
  if (!$clave) {
      return back()->with('Incorrecto', 'No se proporcionó una clave de plan de estudios.');
  }

   // Obtener un alumno con la clave del plan de estudios
   $alumno = DB::table('alumnos')->where('plan_estudio_id', $clave)->get();
   
   // Verificar si se encontró un alumno
   if (!$alumno) {
    return back()->with('Incorrecto', 'No se encontró un alumno con la clave de plan de estudios proporcionada.');
}
  

   // Obtener los grupos asociados con el plan de estudios del alumno
   



  //compactar variables
  return view('Escolares.alumnosDocente', compact('clave','alumno'));
  
  
}


}
