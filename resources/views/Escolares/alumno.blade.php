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


    <h1 class="title is-3 has-text-centered">Alumnos</h1>
    <div class="buttons">
        <a href="{{route('home')}}" class="button is-danger">
            <i class="fa-solid fa-arrow-left"> </i> Regresar </a>
            <button href="{{ route('home') }}" class="button is-primary js-modal-trigger" data-target="modal-nvo-alumno">
                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    Nuevo Alumno
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
                
                <th class="has-text-centered">Materia</th>
                <th class="has-text-centered">Plan de Estudio</th>
                <th class="has-text-centered">Ap Paterno</th>
                <th class="has-text-centered">Ap Materno</th>
                <th class="has-text-centered">Curp</th>
                <th class="has-text-centered">Plan de Estudio</th>
                <th class="has-text-centered">Semestre</th>
                <th class="has-text-centered">Estatus</th>
                <th class="has-text-centered">Tipo de Alumno</th>
               
                <th class="has-text-centered">Opciones</th>
                
            </tr>
        </thead>

        <tbody>
            @foreach ($alumnos  as $item)
            <tr>
                <td class="has-text-centered" >{{$item->numero_de_control}}</td>
                <td class="has-text-centered">{{$item->nombre}}</td>
                <td class="has-text-centered">{{$item->ap_paterno}}</td>
                <td class="has-text-centered">{{$item->ap_materno}}</td>
                <td class="has-text-centered">{{$item->curp}}</td>
                <td class="has-text-centered">{{$item->planEstudio->clave_plan_estudio}}</td>
                <td class="has-text-centered">{{$item->semestre}}</td>
                <td class="has-text-centered">{{$item->estatus->nombre_estatus}}</td>
{{--                 <td class="has-text-centered">{{$item->tipo_alumno->nombre_tipo}}</td>
 --}}          
                <td>
                @foreach ($tipos as $i)
                {{ $item->tipo_de_alumno_id=== $i->id ? $i->nombre_tipo : '' }}
                @endforeach
                </td>
            

                
                
                
                
                <td>
                    <div class="field is-grouped">
                            
                        <button class="button is-warning has-text-white js-modal-trigger" data-target="modalModificaAlumno-{{ $item->id }}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                        <form action="{{ route('AlumnosEliminar', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button is-danger"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar este Alumno?')">
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
                                <p class="title is-5 has-text-centered">Modificar Alumno</p>
                                <form method="GET" action="{{ route('EditarAlumnos', $item->id) }}">
                                    <div class="field">
                                        <label class="label">Numero de comtrol:</label>
                                            <div class="control">
                                                <input class="input" type="text" name="txtNoControl" value="{{$item->numero_de_control }}">
                                            </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Nombre:</label>
                                            <div class="control">
                                                <input class="input" type="text" name="txtNombre" value="{{$item->nombre }}"> 
                                            </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Ap Paterno:</label>
                                            <div class="control">
                                                <input class="input" type="text" name="txtApPaterno" value="{{$item->ap_paterno }}"> 
                                            </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Ap Materno</label>
                                            <div class="control">
                                                <input class="input" type="text" name="txtApMaterno" value="{{$item->ap_materno }}"> 
                                            </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Curp:</label>
                                            <div class="control">
                                                <input class="input" type="text" name="txtCurp" value="{{$item->curp }}"> 
                                            </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Plan de estudio:</label>
                                            <div class="control">
                                                <div class="select">
                                                    <select name="txtPlan2" id="">

                                                        @foreach($planes as $plan)
                                                            <option value="{{$plan->id}}" {{ $plan->id == $item->plan_estudio_id ? 'selected' : ' '  }}  > {{$plan->clave_plan_estudio}}</option>
                                                            
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                            </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Semestre:</label>
                                            <div class="control">
                                                <input class="input" type="text" name="txtSemestre" value="{{$item->semestre }}"> 
                                            </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Estatus:</label>
                                            <div class="control">
                                                <div class="select">
                                                    <select name="txtEstatus" id="">

                                                        @foreach($estatuses as $estatus)
                                                            <option value="{{$estatus->id}}" {{ $estatus->id == $item->estatus_id ? 'selected' : ' '  }}  > {{$estatus->nombre_estatus}}</option>
                                                            
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                            </div>
                                    </div>

                                    


                                    <div class="field">
                                        <label class="label">Tipo de Alumno:</label>
                                            <div class="control">
                                                <div class="select">
                                                    <select name="txtTipoAlumno" id="">

                                                        @foreach($tipos as $tipo)
                                                            <option value="{{$tipo->id}}" {{ $tipo->id == $item->tipo_de_alumno_id ? 'selected' : ' '  }}  > {{$tipo->nombre_tipo}}</option>
                                                            
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                            </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">User:</label>
                                            <div class="control">
                                                <div class="select">
                                                    <select name="txtUsers" id="">

                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}" {{ $user->id == $item->user_id ? 'selected' : ' '  }}  > {{$user->name}}</option>
                                                            
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




            <!--======================= MODAL DE AGREGAR NUEVO  REGISTRO=================-->
                        
            <div id="modal-nvo-alumno" class="modal">
                <div class="modal-background"></div>
                    <div class="modal-content">
                        <div class="box">
                            <p class="title is-5 has-text-centered">Registrar Nuevo Alumno</p>
                            <form method="POST" action="{{ route('generarAlumno', $item->id) }}">
                                @csrf
                                @method('POST')
                                    <div class="field">
                                        <div class="control has-icons-left">
                                            <label class="label">No de Control:</label>
                                                <div class="control has-icons-left">
                                                    <input class="input" type="text" name = "txtNoControl" value="{{ old('txtNoControl') }}">
                                                    <span class="icon is-small is-left">
                                                        <i class="fa-solid fa-key"></i>
                                                    </span>
                                                </div>
                                        </div>
                                        @error('txtNoControl')
                                        <p class="help is-danger">Ingresa el Numero de control</p>
                                        @enderror
                                    </div>

                                    <div class="field">
                                        <div class="control has-icons-left">
                                            <label class="label">Nombre:</label>
                                                <div class="control has-icons-left">
                                                    <input class="input" type="text" name = "txtNombre" value="{{ old('txtNombre') }}">
                                                    <span class="icon is-small is-left">
                                                        <i class="fa-solid fa-key"></i>
                                                    </span>
                                                </div>
                                        </div>
                                        @error('txtNombre')
                                        <p class="help is-danger">Ingresa el Nombre</p>
                                        @enderror
                                    </div>

                                    <div class="field">
                                        <div class="control has-icons-left">
                                            <label class="label">Ap Paterno</label>
                                                <div class="control has-icons-left">
                                                    <input class="input" type="text" name = "txtApPaterno" value="{{ old('txtApPaterno') }}">
                                                    <span class="icon is-small is-left">
                                                        <i class="fa-solid fa-key"></i>
                                                    </span>
                                                </div>
                                        </div>
                                        @error('txtApPaterno')
                                        <p class="help is-danger">Ingresa el Ap Paterno</p>
                                        @enderror
                                    </div>

                                    <div class="field">
                                        <div class="control has-icons-left">
                                            <label class="label">Ap Materno</label>
                                                <div class="control has-icons-left">
                                                    <input class="input" type="text" name = "txtApMaterno" value="{{ old('txtApMaterno') }}">
                                                    <span class="icon is-small is-left">
                                                        <i class="fa-solid fa-key"></i>
                                                    </span>
                                                </div>
                                        </div>
                                        @error('txtApMaterno')
                                        <p class="help is-danger">Ingresa el Ap Materno</p>
                                        @enderror
                                    </div>

                                    <div class="field">
                                        <div class="control has-icons-left">
                                            <label class="label">Curp</label>
                                                <div class="control has-icons-left">
                                                    <input class="input" type="text" name = "txtCurp" value="{{ old('txtCurp') }}">
                                                    <span class="icon is-small is-left">
                                                        <i class="fa-solid fa-key"></i>
                                                    </span>
                                                </div>
                                        </div>
                                        @error('txtCurp ')
                                        <p class="help is-danger">Ingresa el Curp</p>
                                        @enderror
                                    </div>

                                    

                                    <div class="field">
                                        <label class="label">Plan de estudio:</label>
                                            <div class="control">
                                                <div class="select">
                                                    <select name="txtPlan2" id="">

                                                        @foreach($planes as $plan)
                                                            <option value="{{$plan->id}}" {{ $plan->id == $item->plan_estudio_id ? 'selected' : ' '  }}  > {{$plan->clave_plan_estudio}}</option>
                                                            
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                            </div>
                                    </div>



                                    <div class="field">
                                        <div class="control has-icons-left">
                                            <label class="label">Semestre</label>
                                                <div class="control has-icons-left">
                                                    <input class="input" type="text" name = "txtSemestre" value="{{ old('txtSemestre') }}">
                                                    <span class="icon is-small is-left">
                                                        <i class="fa-solid fa-key"></i>
                                                    </span>
                                                </div>
                                        </div>
                                        @error('txtSemestre')
                                        <p class="help is-danger">Ingresa el RFC</p>
                                        @enderror
                                    </div>

                                    <div class="field">
                                        <label class="label">Estatus:</label>
                                            <div class="control">
                                                <div class="select">
                                                    <select name="txtEstatus" id="">

                                                        @foreach($estatuses as $estatus)
                                                            <option value="{{$estatus->id}}" {{ $estatus->id == $item->estatus_id ? 'selected' : ' '  }}  > {{$estatus->nombre_estatus}}</option>
                                                            
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                            </div>
                                    </div>

                                    


                                    <div class="field">
                                        <label class="label">Tipo de Alumno:</label>
                                            <div class="control">
                                                <div class="select">
                                                    <select name="txtTipoAlumno" id="">

                                                        @foreach($tipos as $tipo)
                                                            <option value="{{$tipo->id}}" {{ $tipo->id == $item->tipo_de_alumno_id ? 'selected' : ' '  }}  > {{$tipo->nombre_tipo}}</option>
                                                            
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
            </td>
        <tr>
        
            
            
            
            
            
            
            @endforeach
        </tbody>
    </table>

    
</div>

@endsection
</body>
</html>