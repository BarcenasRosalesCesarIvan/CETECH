<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\PlanEstudio;
use App\Models\Periodo;
use App\Models\Materia;
use App\Models\Docente;
class GrupoController extends Controller
{
    // Funcion para visalizar los datos de la BD
    


    public function getGrupos(){
        //retornar variables

        //retornar el json

        //retornar el json
        $periodos = Periodo::all();
        $planes = PlanEstudio::all();
        $materias = Materia::all();
        $docentes = Docente::all();
        $grupos = Grupo::all();
        
        
        // mandar variables a la lista

        //compactar variables
        return view('Escolares.grupos', compact('periodos','planes','materias','docentes','grupos'));

        
        
      }


      // Funcion de eliminar Grupo
      public function deleteGrupos($id)
    {
    //Hay que recibir como parametro el id del registro a eliminar
    
        try {
            // Buscamos el plan de estudio
            $grupo = Grupo::findOrFail($id);
            // Se elimina
            $grupo->delete();
    
            return back()->with("Correcto", "Se ha eliminado el Grupo");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error al eliminar el Grupo");
        }
    
    
    }

    // Crear

    public function createGrupo(Request $request)
      {
          try {
              $request->validate([
                'txtPeriodo' => 'required',
                'txtPlan' => 'required|string',
                'txtMateria' => 'required|string',
                'txtSemestre' => 'required|string',
                'txtGrupo' => 'required|string',
                'txtCapacidad' => 'required|string',
                'txtDocente' => 'required',
                
                  // Agrega más reglas de validación para otros campos aquí
                  // los 'txt' vienen de la vista
              ]);


              // Crea un nuevo edificio
            $grupo= new Grupo();
            $grupo->periodo_id = $request->txtPeriodo;
            $grupo->planEstudio_id = $request->txtPlan;
            $grupo->materia_id = $request->txtMateria;
            $grupo->semestre = $request->txtSemestre;
            $grupo->letra_grupo = $request->txtGrupo;
            $grupo->capacidad = $request->txtCapacidad;
            $grupo->docente_id = $request->txtDocente;
           
  
          
             

       
              $grupo->save();
 
              return back()->with("Correcto", "Grupo agregado correctamente");
          } catch (QueryException $e) {
              if ($e->errorInfo[1] == 1062) {
                  return back()->with("Incorrecto", "ERROR - Esa clave de grupo  ya existe");
              }
              // Cualquier Otro error
              return back()->with("Incorrecto", "Error al agregar el grupo".$e);

          }
      }
  
    

    // Editar Grupos
    public function updateGrupos(Request $request, $id){
        //traer en json los datos recabados
        //$data = $request->all();
        //return $data;
        try{
        // $plan = select * from planes_estudio where id = $id
        $grupo = Grupo::findOrFail($id);
        
  
  
        $grupo->periodo_id = $request->txtPeriodo;
        $grupo->planEstudio_id = $request->txtPlan;
        $grupo->materia_id = $request->txtMateria;
        $grupo->semestre = $request->txtSemestre;
        $grupo->letra_grupo = $request->txtGrupo;
        $grupo->capacidad = $request->txtCapacidad;
        $grupo->docente_id = $request->txtDocente;
        
        // actualiza los campos
        $grupo->save();
        
  
        return back()->with("Correcto","Se ha actualizado el grupo correctamente");
        }catch (QueryException $e){
          if ($e->errorInfo[1] == 1062){
            return back()->with("Incorrecto","Error, en la clave, no se puede duplicar");
          }else{
            return back()->with("Incorrecto", "Error al agregar el grupo".$e);
          }
        }
      }
  
  
      // eliminar alumno
  
     
  
      public function deleteGrupo($id)
      {
      //Hay que recibir como parametro el id del registro a eliminar
      
          try {
              // Buscamos el plan de estudio
              $grupos = Grupo::findOrFail($id);
              // Se elimina
              $grupos->delete();
      
              return back()->with("Correcto", "Se ha eliminado el Grupo");
          } catch (QueryException $e) {
              // Cualquier  error
              return back()->with("Incorrecto", "Error al eliminar el Grupo");
          }
      
      
      }


      public function getGruposAlumnos(){
        //retornar variables

        //retornar el json

        //retornar el json
        $periodos = Periodo::all();
        $planes = PlanEstudio::all();
        $materias = Materia::all();
        $docentes = Docente::all();
        $grupos = Grupo::all();
        
        
        // mandar variables a la lista

        //compactar variables
        return view('Escolares.gruposAlumnos', compact('periodos','planes','materias','docentes','grupos'));

        
        
      }





}// llave de fin
