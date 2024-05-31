<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MateriaPlanEstudio;
use App\Models\Materia;
use App\Models\PlanEstudio;
use Illuminate\Support\Facades\DB;


class MateriaPlanEstudioController extends Controller
{


    public function getMateriaPlanEstudios(){
        //retornar variables

        //retornar el json
        $mPlan = MateriaPlanEstudio::all();
        $materias = Materia::all();
        $planes = PlanEstudio::all();
        // mandar variables a la lista
      
        //compactar variables
        return view('Escolares.materiaPlanEstudio', compact('materias','planes','mPlan'));
      }

      public function visualizaMP(){
        //retornar variables

        //retornar el json
        $mPlan = MateriaPlanEstudio::all();
        $materias = Materia::all();
        $planes = PlanEstudio::all();
        // mandar variables a la lista
      
        $clave = request()->input('txtClave');
        $ca = request()->input('txtCarrera');
        $cp = request()->input('txtCP');
        $carrera = DB::table('planes_estudio')->where('id','=',$clave)->get();

        $result = DB::table('materia_plan_estudios')->where('plan_estudio_id','=',$clave)->get();

        //compactar variables
        return view('Escolares.visualizaMP', compact('materias','planes','mPlan','clave','result','carrera','ca','cp'));
        
      }


      


      // funcion para editar edificios
    public function updatemateriasPlanEstudios(Request $request, $id){
      //traer en json los datos recabados
      //$data = $request->all();
      //return $data;
      try{
      // $plan = select * from planes_estudio where id = $id
      $mp = MateriaPlanEstudio::findOrFail($id);
      
      //Señala los campos a cambiar
      $mp->materia_id = $request->txtMateria;
      $mp-> plan_estudio_id = $request->txtPlan;
      
      
      // actualiza los campos
      $mp->save();
      

      return back()->with("Correcto","Se ha actualizado la especialidad correctamente");
      }catch (QueryException $e){
        if ($e->errorInfo[1] == 1062){
          return back()->with("Incorrecto","Error, en la clave, no se puede duplicar");
        }else{
          return back()->with("Incorrecto","Es incorrecto ");
        }
      }
    }


    public function deletemateriasPlanesEstudios($id)
{
//Hay que recibir como parametro el id del registro a eliminar

    try {
		    // Buscamos el plan de estudio
        $mp = MateriaPlanEstudio::findOrFail($id);
        // Se elimina
        $mp->delete();

        return back()->with("Correcto", "Se ha eliminado el registro existosamente");
    } catch (QueryException $e) {
        // Cualquier  error
        return back()->with("Incorrecto", "Error al eliminar el registro");
    }


}


public function createmateriasPlanesEstudios(Request $request)
    {
        try {
            $request->validate([
                'txtMateria' => 'required|string',
                'txtPlan' => 'required|string',
                
                
            ]);


            // Crea un nuevo edificio
            $mp = new MateriaPlanEstudio();
            $mp->materia_id = $request->txtMateria;
            $mp->plan_estudio_id = $request->txtPlan;
            
            
            // actualiza los campos
            $mp->save();
          
        

            return back()->with("Correcto", "Materia asignada a plan correctamente");
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Esa clave de especialidad  ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar la materia al plan");
        }
    }




}
