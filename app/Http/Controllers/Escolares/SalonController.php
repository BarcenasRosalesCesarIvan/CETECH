<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salon;

class SalonController extends Controller
{
    


    // funcion para editar edificios
    public function updateSalones(Request $request, $id){
        //traer en json los datos recabados
        //$data = $request->all();
        //return $data;
        try{
        // $plan = select * from planes_estudio where id = $id
        $salon = Salon::findOrFail($id);
        
        //Señala los campos a cambiar
        $salon->nombre_salon = $request->txtNombreSalon;
        $salon->edificio_id = $request->txtSalonEdificio;
        
        // actualiza los campos
        $salon->save();
        
  
        return back()->with("Correcto","Se ha actualizado el salon correctamente");
        }catch (QueryException $e){
          if ($e->errorInfo[1] == 1062){
            return back()->with("Incorrecto","Error, en la clave, no se puede duplicar");
          }else{
            return back()->with("Incorrecto","Es incorrecto ");
          }
        }
      }

      //FUNCION PARA AGREGAR NUEVO edificio
    //Nueva funcion
    public function createSalon(Request $request)
    {
        try {
            $request->validate([
                'txtNombreSalon' => 'required|string',
                'txtSalonEdificio' => 'required|string',
                
            ]);


            // Crea un nuevo edificio
            $salon = new Salon();
            $salon->nombre_salon = $request->txtNombreSalon;
            $salon->edificio_id = $request->txtSalonEdificio;
            
            // actualiza los campos
            $salon->save();
          
        

            return back()->with("Correcto", "Salon agregado correctamente");
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Esa clave de Salon  ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar el Salon");
        }
    }


    // FUNCION PARA ELIMINAR

    public function deleteSalones($id)
{
//Hay que recibir como parametro el id del registro a eliminar

    try {
		    // Buscamos el plan de estudio
        $salon = Salon::findOrFail($id);
        // Se elimina
        $salon->delete();

        return back()->with("Correcto", "Se ha eliminado el Salon");
    } catch (QueryException $e) {
        // Cualquier  error
        return back()->with("Incorrecto", "Error al eliminar el Salon");
    }


}
}
