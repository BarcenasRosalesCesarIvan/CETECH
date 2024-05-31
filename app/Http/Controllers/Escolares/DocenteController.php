<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Grupo;

class DocenteController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
      //retornar variables
      $test = 'Hola mundo';
      $name = 'Cesar ivan';

      //retornar el json

      $planes = Docente::all();
      // mandar variables a la lista
    
      //compactar variables
      return view('Escolares.docente', compact('test','name','planes'));
    }



    

    // Si queremos obtener el request 'lo que se encia desde el formulario'
    public function updateDocentes(Request $request, $id){
      //traer en json los datos recabados
      //$data = $request->all();
      //return $data;
      try{
      // $plan = select * from planes_estudio where id = $id
      $plan = Docente::findOrFail($id);
      
      //Señala los campos a cambiar
      $plan->rfc = $request->txtRfc;
      $plan->nombre = $request->txtNombre;
      $plan->ap_paterno = $request->txtAppaterno;
      $plan->ap_materno = $request->txtApmaterno;
      $plan->curp = $request->txtCurp;
      $plan->email = $request->txtEmail;
     
      // actualiza los campos
      $plan->save();
      

      return back()->with("Correcto","Docente modificado correctamente");
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
    public function createDocente(Request $request)
    {
        try {
            $request->validate([
                'txtRfc' => 'required|string',
                'txtNombre' => 'required|string',
                'txtAppaterno' => 'required|string',
                'txtApmaterno' => 'required|string',
                'txtCurp' => 'required|string',
                'txtEmail' => 'required|string',
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
            $user->assignRole('docente');

            $user->save();

            // Crea un nuevo docente
            $plan = new Docente();
            $plan->rfc = $request->txtRfc;
            $plan->nombre = $request->txtNombre;
            $plan->ap_paterno = $request->txtAppaterno;
            $plan->ap_materno = $request->txtApmaterno;
            $plan->curp = $request->txtCurp;
            $plan->email = $request->txtEmail;
            $plan->user_id = $user->id;
            $fecha_nacimiento = substr($request->txtCurp, 4, 6);

        
            // actualiza los campos
            $plan->save();
          
        

            return back()->with("Correcto", "Docente agregado correctamente");
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Esa clave de Docente  ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar el Docente");
        }
    }



    // FUNCION PARA ELIMINAR

    public function deleteDocente($id)
{
//Hay que recibir como parametro el id del registro a eliminar

    try {
		    // Buscamos el plan de estudio
        $planEstudio = Docente::findOrFail($id);
        // Se elimina
        $planEstudio->delete();

        return back()->with("Correcto", "Se ha eliminado el Docente");
    } catch (QueryException $e) {
        // Cualquier  error
        return back()->with("Incorrecto", "Error al agregar el Docente");
    }
}



    
    
}
