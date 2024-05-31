<?php

namespace App\Http\Controllers\escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\PlanEstudio;
use App\Models\Estatus;
use App\Models\TipoAlumno;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;


class AlumnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index(){
      
  
        //retornar el json
        $alumnos = Alumno::all();
        $planes = PlanEstudio::all();
        $estatuses = Estatus::all();
        $tipos = TipoAlumno::all();
        $users = User::all();
        
        // mandar variables a la lista
      
        //compactar variables
        return view('Escolares.alumno', compact('planes','alumnos','estatuses','tipos','users'));

        
      }


      public function crearAlumno(Request $request)
    {
        try {
            $request->validate([
                'txtNoControl' => 'required|string',
                'txtNombre' => 'required|string',
                'txtApPaterno' => 'required|string',
                'txtApMaterno' => 'required|string',
                'txtCurp' => 'required|string',
                'txtPlan2' => 'required|string',
                'txtSemestre' => 'required|string',
                'txtEstatus' => 'required|string',
                'txtTipoAlumno' => 'required|string',
                'txtUsers' => 'required|string',
                
                // Agrega más reglas de validación para otros campos aquí
                // los 'txt' vienen de la vista
            ]);

            $fecha_nacimiento = substr($request->txtCurp, 4, 6);
            
            //Crea un nuevo usuario    jose.rp@sjuanrio.tecnm.mx ROPJ000000HQTTL32

            $user = User::create([
              'name' => $request->txtNombre.' '.$request->txtAppaterno.' '.$request->txtApmaterno,
              'email' => $request->txtEmail,
              'password' => Hash::make('Tecsj+'. $fecha_nacimiento),
      
            ]);
            $user->assignRole('alumnos');

            $user->save();

            // Crea un nuevo docente

          
            $plan = new Alumno();
            $plan->numero_de_control = $request->txtNoControl;
            $plan->nombre = $request->txtNombre;
            $plan->ap_paterno = $request->txtAppaterno;
            $plan->ap_materno = $request->txtApmaterno;
            $plan->curp = $request->txtCurp;
            $plan->plan_estudio_id = $request->txtPlan;
            $plan->semestre = $request->txtSemestre;
            $plan->estatus_id = $request->txtEstatus;
            $plan->tipo_de_alumno_id = $request->txtTipoAlumno;

            $plan->user_id = $user->id;
            

        
            // actualiza los campos
            $plan->save();
          
        

            return back()->with("Correcto", "Docente agregado correctamente");
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Esa clave de Docente  ya existe".e);
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar el Docente".e);
        }
    }
      
  


      // actualizar alumnos

        // funcion para editar edificios
    public function updateAlumnos(Request $request, $id){
      //traer en json los datos recabados
      //$data = $request->all();
      //return $data;
      try{
      // $plan = select * from planes_estudio where id = $id
      $alumno = Alumno::findOrFail($id);
      


      $alumno->numero_de_control = $request->txtNoControl;
      $alumno->nombre = $request->txtNombre;
      $alumno->ap_paterno = $request->txtApPaterno;
      $alumno->ap_materno = $request->txtApMaterno;
      $alumno->curp = $request->txtCurp;
      $alumno->plan_estudio_id = $request->txtPlan2;
      $alumno->semestre = $request->txtSemestre;
      $alumno->estatus_id = $request->txtEstatus;
      $alumno->tipo_de_alumno_id = $request->txtTipoAlumno;
      $alumno->user_id = $request->txtUsers;


      // actualiza los campos
      $alumno->save();
      

      return back()->with("Correcto","Se ha actualizado el alumno correctamente");
      }catch (QueryException $e){
        if ($e->errorInfo[1] == 1062){
          return back()->with("Incorrecto","Error, en la clave, no se puede duplicar");
        }else{
          return back()->with("Incorrecto", "Error al agregar el alumno".$e);
        }
      }
    }


    // eliminar alumno

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




    public function generarAlumno(Request $request)
    {
        try {
            $request->validate([
                'txtNoControl' => 'required|string',
                'txtNombre' => 'required|string',
                'txtApPaterno' => 'required|string',
                'txtApMaterno' => 'required|string',
                'txtCurp' => 'required|string',
                'txtPlan2' => 'required|string',
                'txtSemestre' => 'required|string',
                'txtEstatus' => 'required|string',
                'txtTipoAlumno' => 'required|string',
                // Agrega más reglas de validación para otros campos aquí
                // los 'txt' vienen de la vista
            ]);
    
            $fecha_nacimiento = substr($request->txtCurp, 4, 6);
            $email = 'L' . $request->txtNoControl . '@sjuanrio.tecnm.mx';
    
            // Crea un nuevo usuario
            $user = User::create([
                'name' => $request->txtNombre . ' ' . $request->txtApPaterno . ' ' . $request->txtApMaterno,
                'email' => $email,
                'password' => Hash::make('Tecsj+' . $fecha_nacimiento),
            ]);
    
            $user->assignRole('alumnos');
    
            // Crea un nuevo alumno
            $alumno = new Alumno();
            $alumno->numero_de_control = $request->txtNoControl;
            $alumno->nombre = $request->txtNombre;
            $alumno->ap_paterno = $request->txtApPaterno;
            $alumno->ap_materno = $request->txtApMaterno;
            $alumno->curp = $request->txtCurp;
            $alumno->plan_estudio_id = $request->txtPlan2;
            $alumno->semestre = $request->txtSemestre;
            $alumno->estatus_id = $request->txtEstatus;
            $alumno->tipo_de_alumno_id = $request->txtTipoAlumno;
            $alumno->user_id = $user->id;
    
            // Guarda el alumno
            $alumno->save();
    
            return back()->with("Correcto", "Alumno agregado correctamente");
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Esa clave de alumno ya existe");
            }
            // Cualquier otro error
            return back()->with("Incorrecto", "Error al agregar el alumno: " . $e->getMessage());
        }
    }
    


}//final
