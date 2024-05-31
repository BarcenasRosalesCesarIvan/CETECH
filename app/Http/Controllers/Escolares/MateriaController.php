<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materia;

class MateriaController extends Controller
{
    public function index(){
        //retornar variables
        
  
        //retornar el json
  
        $materias = Materia::all();
        // mandar variables a la lista
      
        //compactar variables
        return view('Escolares.materias', compact('materias'));
      }

      public function updateMaterias(Request $request, $id){
        //traer en json los datos recabados
        //$data = $request->all();
        //return $data;
        try{
        // $plan = select * from planes_estudio where id = $id
        $materias = Materia::findOrFail($id);
        
        //Señala los campos a cambiar
        $materias->clave_materia = $request->txtClaveMateria;
        $materias->nombre = $request->txtNombre;
        $materias->creditos = $request->txtCreditos;
        
        // actualiza los campos
        $materias->save();
        
  
        return back()->with("Correcto","Materia modificada correctamente");
        }catch (QueryException $e){
          if ($e->errorInfo[1] == 10){
            return back()->with("Incorrecto","Error, en la clave, no se puede duplicar");
          }else{
            return back()->with("Incorrecto","Es incorrecto ");
          }
        }
      }
  
      public function createMateria(Request $request)
      {
          try {
              $request->validate([
                  'txtClaveMateria' => 'required|string',
                  'txtNombre' => 'required|string',
                  'txtCreditos' => 'required|string',
                  
                  // Agrega más reglas de validación para otros campos aquí
                  // los 'txt' vienen de la vista
              ]);
  
              
            
  
              // Crea un nuevo docente
              $materias = new Materia();
              $materias->clave_materia = $request->txtClaveMateria;
              $materias->nombre = $request->txtNombre;
              $materias->creditos = $request->txtCreditos;
              
  
          
              // actualiza los campos
              $materias->save();
            
          
  
              return back()->with("Correcto", "Materia agregado correctamente");
          } catch (QueryException $e) {
              if ($e->errorInfo[1] == 1062) {
                  return back()->with("Incorrecto", "ERROR - Esa clave de Materia  ya existe");
              }
              // Cualquier Otro error
              return back()->with("Incorrecto", "Error al agregar la materia ");
          }
      }

      public function deleteMaterias($id)
{
//Hay que recibir como parametro el id del registro a eliminar

    try {
		    // Buscamos el plan de estudio
        $materias = Materia::findOrFail($id);
        // Se elimina
        $materias->delete();

        return back()->with("Correcto", "Se ha eliminado la materia");
    } catch (QueryException $e) {
        // Cualquier  error
        return back()->with("Incorrecto", "Error al agregar la materia");
    }
}






}// llave del fin
