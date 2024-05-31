<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periodo;

class PeriodoController extends Controller
{
    public function index(){
        //retornar variables
        
  
        //retornar el json
  
        $periodos = Periodo::all();
        // mandar variables a la lista
      
        //compactar variables
        return view('Escolares.periodos', compact('periodos'));
      }

      public function updatePeriodos(Request $request, $id){
        //traer en json los datos recabados
        //$data = $request->all();
        //return $data;
        try{
        // $plan = select * from planes_estudio where id = $id

        $numero = null;
  
              // Extraer los últimos dos dígitos del año
              $year = substr($request->txtYear, -2);

              if($request->txtOpcionesPeriodo == 'Enero-Junio') {
                $numero = '1';
            }else{
              if($request->txtOpcionesPeriodo == 'Agosto-Diciembre'){
                $numero = '2';
              }else{
                if($request->txtOpcionesPeriodo == 'Verano'){
                  $numero = '3';
                }
              }
            }

        $year = substr($request->txtYear, -2);
        


        $periodos = Periodo::findOrFail($id);
        
        //Señala los campos a cambiar
        $periodos->clave_periodo = $year . '/' . ($numero ?? '0');
        $periodos->nombre_periodo = $request->txtOpcionesPeriodo;
        $periodos->estatus = $request->txtEstatus;

      

         
        
        // actualiza los campos
        $periodos->save();
        
  
        return back()->with("Correcto","Periodo modificado correctamente");
        }catch (QueryException $e){
          if ($e->errorInfo[1] == 10){
            return back()->with("Incorrecto","Error, en la clave, no se puede duplicar");
          }else{
            return back()->with("Incorrecto","Es incorrecto ");
          }
        }
      }
  
      public function createPeriodos(Request $request)
      {
          try {
              $request->validate([
                  'txtYear' => 'required|string',
                  'txtOpcionesPeriodo' => 'required|string',                
                  //'txtNombrePeriodo' => 'required|string',
                  'txtEstatus' => 'required|string',
                  
                  // Agrega más reglas de validación para otros campos aquí
                  // los 'txt' vienen de la vista
              ]);

              $numero = null;
  
              // Extraer los últimos dos dígitos del año
              $year = substr($request->txtYear, -2);

              if($request->txtOpcionesPeriodo == 'Enero-Junio') {
                $numero = '1';
            }else{
              if($request->txtOpcionesPeriodo == 'Agosto-Diciembre'){
                $numero = '2';
              }else{
                if($request->txtOpcionesPeriodo == 'Verano'){
                  $numero = '3';
                }
              }
            }

             

              
            
               // Crea un nuevo docente
              $periodos = new Periodo();
                $periodos->clave_periodo = $year . '/' . ($numero ?? '0');
              $periodos->nombre_periodo = $request->txtOpcionesPeriodo;
              $periodos->estatus = $request->txtEstatus;
  
          
              // actualiza los campos
              $periodos->save();
            
          
  
              return back()->with("Correcto", "Periodo agregado correctamente");
          } catch (QueryException $e) {
              if ($e->errorInfo[1] == 1062) {
                  return back()->with("Incorrecto", "ERROR - Esa clave de Periodo  ya existe");
              }
              // Cualquier Otro error
              return back()->with("Incorrecto", "Error al agregar el periodo ");
          }
      }

      public function deletePeriodos($id)
{
//Hay que recibir como parametro el id del registro a eliminar

    try {
		    // Buscamos el plan de estudio
        $periodos = Periodo::findOrFail($id);
        // Se elimina
        $periodos->delete();

        return back()->with("Correcto", "Se ha eliminado el periodo");
    } catch (QueryException $e) {
        // Cualquier  error
        return back()->with("Incorrecto", "Error al agregar el periodo");
    }
}

}
