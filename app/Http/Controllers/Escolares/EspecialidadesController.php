<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Especialidades;

class EspecialidadesController extends Controller
{
    public function index(){
    

        //retornar el json
  
        $planes = PlanEstudio::all();
        $especialidades = Especialidades::all();
        
        // mandar variables a la lista
      
        //compactar variables
        return view('Escolares.planesEstudioEspecialidades', compact('planes','especialidades'));
      }



      public function createEspecialidades(Request $request)
    {
        try {
            $request->validate([
                'txtClaveEspecialidad' => 'required|string',
                'txtEspe' => 'required|string',
                'txtPlan' => 'required|string',
                
            ]);


            // Crea un nuevo edificio
            $especialidad = new Especialidades();
            $especialidad->clave_especialidad = $request->txtClaveEspecialidad;
            $especialidad->especialidades = $request->txtEspe;
            $especialidad->plan_estudio_id = $request->txtPlan;
            
            // actualiza los campos
            $especialidad->save();
          
        

            return back()->with("Correcto", "Especialidad agregada correctamente");
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Esa clave de especialidad  ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar la especialidad");
        }
    }


    public function deleteEspecialidades($id)
{
//Hay que recibir como parametro el id del registro a eliminar

    try {
		    // Buscamos el plan de estudio
        $espe = Especialidades::findOrFail($id);
        // Se elimina
        $espe->delete();

        return back()->with("Correcto", "Se ha eliminado la especialidad");
    } catch (QueryException $e) {
        // Cualquier  error
        return back()->with("Incorrecto", "Error al eliminar la especialidad");
    }


}

// funcion para editar edificios
    public function updateEspecialidades(Request $request, $id){
        //traer en json los datos recabados
        //$data = $request->all();
        //return $data;
        try{
        // $plan = select * from planes_estudio where id = $id
        $espe = Especialidades::findOrFail($id);
        
        //Señala los campos a cambiar
        $espe->clave_especialidad = $request->txtClave2;
        $espe->especialidades = $request->txtEspecialidades2;
        $espe->plan_estudio_id = $request->txtPlan2;
        
        // actualiza los campos
        $espe->save();
        
  
        return back()->with("Correcto","Se ha actualizado la especialidad correctamente");
        }catch (QueryException $e){
          if ($e->errorInfo[1] == 1062){
            return back()->with("Incorrecto","Error, en la clave, no se puede duplicar");
          }else{
            return back()->with("Incorrecto","Es incorrecto ");
          }
        }
      }


}// final
