<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Document</title>
</head>
<body>
    
    @extends('Layouts.plantilla')
    @section('content')

<div class="box">


    <h1 class="title is-3 has-text-centered">Grupos</h1>
    <div class="buttons">
        <a href="{{route('home')}}" class="button is-danger">
            <i class="fa-solid fa-arrow-left"> </i> Regresar </a>
            <button href="{{ route('home') }}" class="button is-primary js-modal-trigger" data-target="modal-nvo-alumno">
                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    Nuevo Grupo
            </button>
    </div>

   @if (session('Correcto'))
   <div class="notification  has-text-centered is-success is-light">
   <button class="delete"></button>
    {{session('Correcto')}}
   </div>
   @endif

   @if (session('Incorrecto'))
   <div class="notification  has-text-centered is-danger is-light">
   <button class="delete"></button>
    {{session('Incorrecto')}}
   </div>
   @endif

    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr>
                
                <th class="has-text-centered">Periodo</th>
                <th class="has-text-centered">Plan de Estudio</th>
                <th class="has-text-centered">Materia</th>
                <th class="has-text-centered">Semestre</th>
                <th class="has-text-centered">Grupo</th>
                <th class="has-text-centered">Capacidad</th>
                <th class="has-text-centered">Docente</th>
               
                <th class="has-text-centered">Opciones</th>
                
            </tr>
        </thead>

        <tbody>
            @foreach ($grupos  as $item)
            <tr>
                <td>
                    @foreach ($periodos as $i)
                    {{ $item->periodo_id=== $i->id ? $i->nombre_periodo : '' }}
                    @endforeach
                </td>
                <td>
                    @foreach ($planes as $i)
                    {{ $item->planEstudio_id=== $i->id ? $i->clave_plan_estudio : '' }}
                    @endforeach
                </td>
                <td>
                    @foreach ($materias as $i)
                    {{ $item->materia_id=== $i->id ? $i->nombre : '' }}
                    @endforeach
                </td>
                <td class="has-text-centered">{{$item->semestre}}</td>
                <td class="has-text-centered">{{$item->letra_grupo}}</td>
                <td class="has-text-centered">{{$item->capacidad}}</td>
                <td>
                    @foreach ($docentes as $i)
                    {{ $item->docente_id=== $i->id ? $i->nombre : '' }}
                    @endforeach
                </td>

                <td>
                    <div class="field is-grouped">
                            
                        <button class="button is-warning has-text-white js-modal-trigger" data-target="modalModificaAlumno-{{ $item->id }}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                        <form action="{{ route('GruposEliminar', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button is-danger"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar este Grupo?')">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                    </td>

             
                       <!-- ======================= MODALES DE MODIFICAR PLAN ESTUDIO =====================================-->

                <div id="modalModificaAlumno-{{ $item->id }}" class="modal">
                    <div class="modal-background"></div>                
                        <div class="modal-content">
                            <div class="box">
                                <p class="title is-5 has-text-centered">Modificar Grupos</p>
                                <form method="GET" action="{{ route('EditarGrupos', $item->id) }}">

                                    <div class="field" style="display:none;">
                                        <label class="label">Periodo:</label>
                                        <div class="control">
                                            <input class="input hidden" type="text" name="txtPeriodo" value="{{$item->periodo_id }}"> 
                                        </div>
                                    </div>

                                    <div class="field" style="display:none;">
                                        <label class="label">Plan de Estudio:</label>
                                        <div class="control">
                                            <input class="input hidden" type="text" name="txtPlan" value="{{$item->planEstudio_id }}"> 
                                        </div>
                                    </div>
                                  
                                    <div class="field" style="display:none;">
                                        <label class="label">Materia:</label>
                                        <div class="control">
                                            <input class="input hidden" type="text" name="txtMateria" value="{{$item->materia_id }}"> 
                                        </div>
                                    </div>
                                    
                                  
                                  


                                    <div class="field">
                                        <label class="label">Semestre:</label>
                                        <div class="control">
                                            <div class="select is-fullwidth">
                                                <select name="txtSemestre">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                </select>
                                            </div>
                                        </div>
                                        @error('txtSemestre')
                                        <p class="help is-danger">Ingresa el Semestre</p>
                                        @enderror
                                    </div>

                                    <div class="field">
                                        <label class="label">Grupo:</label>
                                        <div class="control">
                                            <div class="select is-fullwidth">
                                                <select name="txtGrupo">
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                  
                                                </select>
                                            </div>
                                        </div>
                                        @error('txtGrupo')
                                        <p class="help is-danger">Ingresa el Grupo</p>
                                        @enderror
                                    </div>

                                    <div class="field">
                                        <label class="label">Capacidad:</label>
                                            <div class="control">
                                                <input class="input" type="text" name="txtCapacidad" value="{{$item->capacidad }}"> 
                                            </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Docente:</label>
                                            <div class="control">
                                                <div class="select">
                                                    <select name="txtDocente" id="">
    
                                                        @foreach($docentes as $docente)
                                                            <option value="{{$docente->id}}" {{ $docente->id == $item->docente_id ? 'selected' : ' '  }}  > {{$docente->nombre}}</option>
                                                            
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                            </div>
                                    </div>
                                    
                                    <div class="has-text-centered">
                                        <button class="button is-primary" type="submit">Guardar</a>
                                    </div>
                                </form>
                                            <!-- Your content -->
                            </div>
                        </div>
                        
                            <button class="modal-close is-large" aria-label="close"></button>
                            
                </div>

            <!-- MODAL DE AGREGAR REGISTRO -->

                   <!--======================= MODAL DE AGREGAR NUEVO  REGISTRO=================-->
                        
            <div id="modal-nvo-alumno" class="modal">
                <div class="modal-background"></div>
                    <div class="modal-content">
                        <div class="box">
                            <p class="title is-5 has-text-centered">Registrar Nuevo Alumno</p>
                            <form method="POST" action="{{ route('GrupoCrear', $item->id) }}">
                                @csrf
                                @method('POST')
                                <div class="field">
                                    <label class="label">Periodo:</label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="txtPeriodo" id="">

                                                    @foreach($periodos as $periodo)
                                                        <option value="{{$periodo->id}}" {{ $periodo->id == $item->periodo_id ? 'selected' : ' '  }}  > {{$periodo->nombre_periodo}}</option>
                                                        
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                        </div>
                                </div>
                                
                                <div class="field">
                                    <label class="label">Plan de Estudio:</label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="txtPlan" id="">

                                                    @foreach($planes as $plan)
                                                        <option value="{{$plan->id}}" {{ $plan->id == $item->planEstudio_id ? 'selected' : ' '  }}  > {{$plan->clave_plan_estudio}}</option>
                                                        
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                        </div>
                                </div>

                                <div class="field">
                                    <label class="label">Materia:</label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="txtMateria" id="">

                                                    @foreach($materias as $materia)
                                                        <option value="{{$materia->id}}" {{ $materia->id == $item->materia_id ? 'selected' : ' '  }}  > {{$materia->nombre}}</option>
                                                        
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                        </div>
                                </div>


                                <div class="field">
                                    <label class="label">Semestre:</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select name="txtSemestre">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </div>
                                    </div>
                                    @error('txtSemestre')
                                    <p class="help is-danger">Ingresa el Semestre</p>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label class="label">Grupo:</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select name="txtGrupo">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                              
                                            </select>
                                        </div>
                                    </div>
                                    @error('txtGrupo')
                                    <p class="help is-danger">Ingresa el Grupo</p>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label class="label">Capacidad:</label>
                                        <div class="control">
                                            <input class="input" type="text" name="txtCapacidad" value="{{$item->capacidad }}"> 
                                        </div>
                                </div>

                                <div class="field">
                                    <label class="label">Docente:</label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="txtDocente" id="">

                                                    @foreach($docentes as $docente)
                                                        <option value="{{$docente->id}}" {{ $docente->id == $item->docente_id ? 'selected' : ' '  }}  > {{$docente->nombre}}</option>
                                                        
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                        </div>
                                </div>


                                    

                                    
                                    <div class="has-text-centered">
                                        <button class="button is-primary" type="submit"><i
                                            class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</a>
                                    </div>
                            </form>                    
                    </div>
                </div>
                    <button class="modal-close is-large" aria-label="close"></button>
            </div>
        </div>
                @if ($errors->has('txtRfc') || $errors->has('txtNombre') || $errors->has('txtAppaterno')
                || $errors->has('txtApmaterno') || $errors->has('txtCurp') || $errors->has('txtEmail'));
                    <script>
                        document.getElementById('modal-nvo-plan').classList.add('is-active');
                    </script>
                @endif
       

                                    


            <!-- FINAL  -->
            </td>
        <tr>
        
            
            
            
            
            
            
            @endforeach
        </tbody>
    </table>

    
</div>

@endsection
</body>
</html>