<?php

namespace App\Http\Controllers\Escolares;
use App\Models\Edificio;
use App\Models\Salon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EdificioController extends Controller
{
    public function getEdificios(){
        //retornar variables
        $test = 'Hola mundo';
        $name = 'Cesar ivan';
  
        //retornar el json
  
        $edificios =Edificio::all();
        $salones =Salon::all();
        // mandar variables a la lista
      
        //compactar variables
        return view('Escolares.edificio', compact('test','name','edificios','salones'));
      }


    // funcion para editar edificios
    public function updateEdificio(Request $request, $id){
        //traer en json los datos recabados
        //$data = $request->all();
        //return $data;
        try{
        // $plan = select * from planes_estudio where id = $id
        $plan = Edificio::findOrFail($id);
        
        //Señala los campos a cambiar
        $plan->nombre_edificio = $request->txtNombreEdificio;
        $plan->descripcion = $request->txtDescripcion;
        
        // actualiza los campos
        $plan->save();
        
  
        return back()->with("Correcto","Se ha actualizado el edificio correctamente");
        }catch (QueryException $e){
          if ($e->errorInfo[1] == 10){
            return back()->with("Incorrecto","Error, en la clave, no se puede duplicar");
          }else{
            return back()->with("Incorrecto","Es incorrecto ");
          }
        }
      }

      //FUNCION PARA AGREGAR NUEVO edificio
    //Nueva funcion
    public function createEdificios(Request $request)
    {
        try {
            $request->validate([
                'txtNombreEdificio' => 'required|string',
                'txtDescripcion' => 'required|string',
                
            ]);


            // Crea un nuevo edificio
            $plan = new Edificio();
            $plan->nombre_edificio = $request->txtNombreEdificio;
            $plan->descripcion = $request->txtDescripcion;
            
            // actualiza los campos
            $plan->save();
          
        

            return back()->with("Correcto", "Edificio agregado correctamente");
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Esa clave de Edificio  ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar el Edficio");
        }
    }


    // FUNCION PARA ELIMINAR

    public function deleteEdificio($id)
{
//Hay que recibir como parametro el id del registro a eliminar

    try {
		    // Buscamos el plan de estudio
        $planEstudio = Edificio::findOrFail($id);
        // Se elimina
        $planEstudio->delete();

        return back()->with("Correcto", "Se ha eliminado el Edificio");
    } catch (QueryException $e) {
        // Cualquier  error
        return back()->with("Incorrecto", "Error al eliminar el Edificio");
    }


}//end key


}
