@extends('Layouts.plantilla')
@section('content')

<div class="buttons">
    <a href="{{route('home')}}" class="button is-danger">
        <i class="fa-solid fa-arrow-left"> </i> Regresar </a>
        
        <button href="{{ route('home') }}" class="button is-primary js-modal-trigger" data-target="modal-nvo-planEstudios">
            <i class="fa-solid fa-book"></i>
                Agregar nuevo Plan de Estudios
        </button>
        <button href="{{ route('home') }}" class="button is-primary js-modal-trigger" data-target="modal-nvo-especialidad">
            <i class="fa-solid fa-bookmark"></i>
                Agregar nuevo Especialidad
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

<div class="columns">
    <div class="column">
        <div class="box">


            <h1 class="title is-3 has-text-centered">Planes de estudio</h1>
           
        
          
        
            <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        
                        <th class="has-text-centered">Clave de Plan de Estudios</th>
                        <th class="has-text-centered">Carrera</th>
                        <th class="has-text-centered">Opciones</th>
                        
                    </tr>
                </thead>
        
                <tbody>
                    <tbody>
                        @foreach ($planes as $plan)
                        <tr>
                            <td class="has-text-centered" >{{$plan->clave_plan_estudio}}</td>
                            <td class="has-text-centered">{{$plan->carrera}}</td>
                            <td>
                                <div class="field is-grouped">
                            
                                    <button class="button is-warning has-text-white js-modal-trigger" data-target="modalPlan-{{ $plan->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
            
                                    <form action="{{ route('PlanesEstudioEliminar', $plan->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button is-danger" {{ $plan->especialidades->count() > 0 ? 'disabled' : ' '  }}
                                        <button type="submit" class="button is-danger"
                                            onclick="return confirm('¿Estás seguro de que quieres eliminar este Plan de Estudio?')">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>

                                       
                                    </form>
                                    <form action="{{ route('visualizaMP', ['id' => $plan->id, 'carrera' => $plan->carrera, 'clave_plan_estudio' => $plan->clave_plan_estudio]) }}" method="GET">
                                        <input type="hidden" name="txtClave" value="{{ $plan->id }}">
                                        <input type="hidden" name="txtCarrera" value="{{ $plan->carrera }}">
                                        <input type="hidden" name="txtCP" value="{{ $plan->clave_plan_estudio }}">
                                        <button type="submit" class="button is-link has-text-white">
                                            <i class="fa-solid fa-book"></i>
                                        </button>
                                    </form>

                                    
                                        <div class="field is-grouped">
                                            <form action="{{ route('gruposPlanes', [ 'id' => $plan->id]) }}" method="GET">

                                                <input type="hidden" name="txtPlan" value="{{ $plan->id }}">
                                                <button type="submit" class="button is-link has-text-white">
                                                   <p class="is-size-7 has-text-black"> <i class="fa-solid fa-book"> Grupos</i></p>
                                                </button>
                                            </form>
                                        </div>
                                    
                                    
                                </div>
                            </td>
        
                        <!-- ======================= MODALES DE MODIFICAR PLAN ESTUDIO =====================================-->

                <div id="modalPlan-{{ $plan->id }}" class="modal">
                    <div class="modal-background"></div>                
                        <div class="modal-content">
                            <div class="box">
                                <p class="title is-5 has-text-centered">Modificar Plan de Estudio</p>
                                <form method="GET" action="{{ route('PlanesEstudioEditar', $plan->id) }}">
                                    <div class="field">
                                        <label class="label">Clave del Plan de Estudios:</label>
                                            <div class="control">
                                                <input class="input" type="text" name="txtClave" value="{{$plan->clave_plan_estudio }}">
                                            </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Nombre de la carrera:</label>
                                            <div class="control">
                                                <input class="input" type="text" name="txtCarrera" value="{{$plan->carrera }}"> 
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



                <!-- ====================== MODAL PARA ABRIR MATERIAS =========================== -->
                
                <div id="modalMateria-{{ $plan->id }}" class="modal">
                    <div class="modal-background"></div>                
                        <div class="modal-content">
                            <div class="box">
                                
                                <form method="GET" action="{{ route('visualizaMP', $plan->id) }}">
                                    <div class="field">
                                
                                            <div class="control">
                                                <input type="hidden"  name="txtClave" value="{{$plan->id }}">
                                                <input type="hidden"  name="txtCarrera" value="{{$plan->carrera }}">
                                                <input type="hidden"  name="txtCP" value="{{$plan->clave_plan_estudio }}">
                                                
                                            </div>
                                    </div>
                                    
                                    <div class="has-text-centered">
                                        <button class="button is-primary" type="submit">Consultar</a>
                                    </div>
                                </form>
                                            <!-- Your content -->
                            </div>
                        </div>
                        
                            <button class="modal-close is-large" aria-label="close"></button>
                            
                </div>


        
                    <!--======================= MODAL DE AGREGAR NUEVO  REGISTRO=================-->
                                
                    <div id="modal-nvo-especialidad" class="modal">
                        <div class="modal-background"></div>
                            <div class="modal-content">
                                <div class="box">
                                    <p class="title is-5 has-text-centered">Agregar Nuevo Especilidad</p>
                                    <form method="POST" action="{{ route('EspecialidadCrear', $plan->id) }}">
                                        @csrf
                                        @method('POST')
                                            <div class="field">
                                                <div class="control has-icons-left">
                                                    <label class="label">Clave Especialidad:</label>
                                                        <div class="control has-icons-left">
                                                            <input class="input" type="text" name = "txtClaveEspecialidad" value="{{ old('txtClaveEspecialidad') }}">
                                                            <span class="icon is-small is-left">
                                                                <i class="fa-solid fa-key"></i>
                                                            </span>
                                                        </div>
                                                </div>
                                                @error('txtClaveEspecialidad')
                                                <p class="help is-danger">Ingresa la clave de la Especialidad</p>
                                                @enderror
                                            </div>
        
                                            <div class="field">
                                                <div class="control has-icons-left">
                                                    <label class="label">Especialidades:</label>
                                                        <div class="control has-icons-left">
                                                            <input class="input" type="text" name = "txtEspe" value="{{ old('txtEspe') }}">
                                                            <span class="icon is-small is-left">
                                                                <i class="fa-solid fa-key"></i>
                                                            </span>
                                                        </div>
                                                </div>
                                                @error('txtEspe')
                                                <p class="help is-danger">No has ingresado la especialidad</p>
                                                @enderror
                                            </div>

                                            <div class="field">
                                                <label class="label">Plan:</label>
                                                    <div class="control">
                                                        <div class="select">
                                                            <select name="txtPlan" id="">
                                                                
                                                                @foreach($planes as $plan)
                                                                    <option value="{{$plan->id}}">{{$plan->clave_plan_estudio}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                            </div>
                                            
        
                                          
                                            
                                            <div class="has-text-centered">
                                                <button class="button is-primary" type="submit"><i
                                                    class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar Edificio</a>
                                            </div>
                                    </form>                    
                            </div>
                        </div>
                            <button class="modal-close is-large" aria-label="close"></button>
                    </div>
                </div>
                        @if ($errors->has('txtNombreEdificio') || $errors->has('txtDescripcion'));
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
    </div>

    <div class="column">
        <div class="box">
            <h1 class="title is-3 has-text-centered">Especialidades</h1>
            
            <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        
                        <th class="has-text-centered">Clave Plan Estudios</th>
                        <th class="has-text-centered">Nombre</th>
                        <th class="has-text-centered">Carrera</th>
                        <th class="has-text-centered">Opciones</th>
                        
                    </tr>
                </thead>
        
                <tbody>
                    @foreach ($especialidades as $espe)
                    <tr>
                        <td class="has-text-centered" >{{$espe->planEstudio->clave_plan_estudio}}</td>
                        <td class="has-text-centered" >{{$espe->clave_especialidad}}</td>
                        <td class="has-text-centered" >{{$espe->especialidades}}</td>
                      
                        

                        <td>
                            <div class="field is-grouped">
                                    
                                <button class="button is-warning has-text-white js-modal-trigger" data-target="modal-especialidad-{{ $espe->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
        
                                <form action="{{ route('EspecialidadEliminar', $espe->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="submit" class="button is-danger"
                                        onclick="return confirm('¿Estás seguro de que quieres eliminar este Edificio?')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>

                                    
                                </form>
                            </div>
                            </td>


                <!-- ======================= MODALES DE MODIFICAR ESPECIALIDAD =====================================-->
        
                <div id="modal-especialidad-{{ $espe->id }}" class="modal">
                    <div class="modal-background"></div>                
                        <div class="modal-content">
                            <div class="box">
                                <p class="title is-5 has-text-centered">Modificar Especialidad</p>
                                <form method="GET" action="{{ route('EditarEspecialidades', $espe->id) }}">
                                    <div class="field">
                                        <label class="label">Clave Especialidad</label>
                                            <div class="control">
                                                <input class="input" type="text" name="txtClave2" value="{{$espe->clave_especialidad }}">
                                            </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Especialidades</label>
                                            <div class="control">
                                                <input class="input" type="text" name="txtEspecialidades2" value="{{$espe->especialidades }}">
                                            </div>
                                    </div>


                                    <div class="field">
                                        <label class="label">Plan de estudio:</label>
                                            <div class="control">
                                                <div class="select">
                                                    <select name="txtPlan2" id="">
                                                       
                                                        

                                                        @foreach($planes as $plan)
                                                            <option value="{{$plan->id}}" {{ $plan->id == $espe->plan_estudio_id ? 'selected' : ' '  }}  > {{$plan->clave_plan_estudio}}</option>
                                                            
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



        
                 
        
        
                     <!--======================= MODAL DE AGREGAR NUEVA ESPECIALIDAD=================-->
                        
            <div id="modal-nvo-planEstudios" class="modal">
                <div class="modal-background"></div>
                    <div class="modal-content">
                        <div class="box">
                            <p class="title is-5 has-text-centered">Agregar Plan de Estudio</p>
                            <form method="POST" action="{{ route('PlanesEstudioCrear', $plan->id) }}">
                                @csrf
                                @method('POST')
                                    <div class="field">
                                        <div class="control has-icons-left">
                                            <label class="label">Clave del Plan de Estudios:</label>
                                                <div class="control has-icons-left">
                                                    <input class="input" type="text" name = "txtClave" value="{{ old('txtClave') }}">
                                                    <span class="icon is-small is-left">
                                                        <i class="fa-solid fa-key"></i>
                                                    </span>
                                                </div>
                                        </div>
                                        @error('txtClave')
                                        <p class="help is-danger">Ingresa la clave del plan de estudios</p>
                                        @enderror
                                    </div>
                                    <div class="field">
                                        <div class="control has-icons-left">
                                            <label class="label">Nombre de la carrera:</label>
                                                <div class="control has-icons-left">
                                                    <input class="input" type="text" name = "txtCarrera"
                                                        value="{{ old('txtCarrera') }}">
                                                        <span class="icon is-small is-left">
                                                            <i class="fa-solid fa-graduation-cap"></i>
                                                        </span>
                                                </div>
                                        </div>
                                        @error('txtCarrera')
                                            <p class="help is-danger">Ingresa el nombre de la carrera</p>
                                        @enderror
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
                @if ($errors->has('txtClave') || $errors->has('txtCarrera'));
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
    </div>
</div>




@endsection