<?php

namespace App\Http\Controllers;

use App\Models\PlanEstudio;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Especialidades;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Grupo;
use App\Models\User;
use App\Models\Periodo;
use App\Models\Materia;
use App\Models\Docente;
use App\Models\Alumno;
use Illuminate\Support\Facades\Hash;


class EscolaresPlanEstudiosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
    

      //retornar el json

      $planes = PlanEstudio::all();
      $especialidades = Especialidades::all();
      
      // mandar variables a la lista
    
      //compactar variables
      return view('Escolares.planesEstudioEspecialidades', compact('planes','especialidades'));
    }

   

    // Si queremos obtener el request 'lo que se encia desde el formulario'
    public function updatePlanEstudio(Request $request, $id){
      //traer en json los datos recabados
      //$data = $request->all();
      //return $data;
      try{
      // $plan = select * from planes_estudio where id = $id
      $plan = PlanEstudio::findOrFail($id);
      
      //Señala los campos a cambiar
      $plan->clave_plan_estudio = $request->txtClave;
      $plan->carrera = $request->txtCarrera;

      // actualiza los campos
      $plan->save();
      return back()->with("Correcto","Plan de estudio modificado correctamente");
      }catch (QueryException $e){
        if ($e->errorInfo[1] == 10){
          return back()->with("Incorrecto","Error, en la clave, no se puede duplicar");
        }else{
          return back()->with("Incorrecto","Es incorrecto ");
        }
      }
    }

    //FUNCION PARA AGREGAR NUEVO
    //Nueva funcion
    public function createPlanEstudio(Request $request)
    {
        try {
            $request->validate([
                'txtClave' => 'required|string',
                'txtCarrera' => 'required|string',
                // Agrega más reglas de validación para otros campos aquí
                // los 'txt' vienen de la vista
            ]);

            // Crea un nuevo plan
            $plan = new PlanEstudio();
            $plan->clave_plan_estudio = $request->txtClave;
            $plan->carrera = $request->txtCarrera;

            $plan->save(); //Guardamos

            return back()->with("Correcto", "Plan de estudio agregado correctamente");
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Esa clave de plan de estudios ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar el plan de estudios");
        }
    }



    // FUNCION PARA ELIMINAR

    public function deletePlanEstudio($id)
{
//Hay que recibir como parametro el id del registro a eliminar

    try {
		    // Buscamos el plan de estudio
        $planEstudio = PlanEstudio::findOrFail($id);
        // Se elimina
        $planEstudio->delete();

        return back()->with("Correcto", "Se ha eliminado el plan de estudio correctamente");
    } catch (QueryException $e) {
        // Cualquier  error
        return back()->with("Incorrecto", "Error al eliminar el plan de estudios");
    }
}


public function visualizaGrupos(){
  //retornar variables

 
  // mandar variables a la lista

  $clave = request()->input('txtPlan');
      //retornar el json
      $periodos = Periodo::all();
      $planes = PlanEstudio::all();
      $materias = Materia::all();
      $docentes = Docente::all();
      $grupos = Grupo::all();

  
  
  $result = DB::table('grupos')->where('planEstudio_id','=',$clave)->get();

  

  //compactar variables
  return view('Escolares.gruposPlanes', compact('clave','result','periodos','planes','materias','docentes','grupos'));
  
  
}


public function visualizaAlumnos(){
  //retornar variables

 
  // mandar variables a la lista

  $clave = request()->input('txtPlan');
      //retornar el json
      $periodos = Periodo::all();
      $planes = PlanEstudio::all();
      $materias = Materia::all();
      $docentes = Docente::all();
      $grupos = Grupo::all();
      $usuarios = User::all();
      
  
  
  $result = DB::table('alumnos')->where('plan_estudio_id','=',$clave)->get();

  

  //compactar variables
  return view('Escolares.alumnosGrupos', compact('clave','result','periodos','planes','materias','docentes','grupos','usuarios'));
  
  
}


public function createAlumno(Request $request)
{
    try {
        $request->validate([
          'txtNumber' => 'required',
          'txtNombre' => 'required|string',
          'txtAPPaterno' => 'required|string',
          'txtAPMaterno' => 'required|string',
          'txtCurp' => 'required|string',
          'txtPlan' => 'required|string',
          'txtSemestre' => 'required',
          'txtEstatus' => 'required',
          'txtTipo' => 'required',
          
            // Agrega más reglas de validación para otros campos aquí
            // los 'txt' vienen de la vista
        ]);


        // Crea un nuevo edificio
      $alumno= new Alumno();
      $alumno->numero_de_control = $request->txtNumber;
      $alumno->nombre = $request->txtNombre;
      $alumno->ap_paterno = $request->txtAPPaterno;
      $alumno->ap_materno = $request->txtAPMaterno;
      $alumno->curp = $request->txtCurp;
      $alumno->plan_estudio_id = $request->txtPlan;
      $alumno->semestre = $request->txtSemestre;
      $alumno->estatus_id = $request->txtEstatus;
      $alumno->tipo_de_alumno_id = $request->txtTipo;
      

    
        // actualiza los campos
     

        $fecha_nacimiento = substr($request->txtCurp, 4, 6);
      

         // Genera el email y la contraseña
        $email = 'L' . $request->txtNumber . '@sjuanrio.tecnm.mx';
        $fecha_nacimiento = substr($request->txtCurp, 4, 6);
    


        
        $user = User::create([
          'name' => $request->txtNombre . ' ' . $request->txtAPPaterno . ' ' . $request->txtAPMaterno,
          'email' => $email,
          'password'=> ('Tecsj+'. $fecha_nacimiento)
      ]);
        $user->assignRole('alumnos');
        $alumno->user_id = $user->id;

 
        $alumno->save();
      
   
     
       

      
      
    

        return back()->with("Correcto", "alumno agregado correctamente");
    } catch (QueryException $e) {
        if ($e->errorInfo[1] == 1062) {
            return back()->with("Incorrecto", "ERROR - Esa clave de alumno  ya existe".$e);
        }
        // Cualquier Otro error
        return back()->with("Incorrecto", "Error al agregar el alumno".$e);

    }
}

// delete alumnos

public function deleteAlumnos($id)
    {
    //Hay que recibir como parametro el id del registro a eliminar
    
        try {
            // Buscamos el plan de estudio
            $alumno = Alumno::findOrFail($id);
            // Se elimina
            $alumno->delete();
    
            return back()->with("Correcto", "Se ha eliminado el Alumno");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error al eliminar el Alumno");
        }
    
    
    }


    
}
