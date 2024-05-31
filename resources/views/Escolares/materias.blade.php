@extends('Layouts.plantilla')
@section('content')

<div class="box">


    <h1 class="title is-3 has-text-centered">Materias</h1>
    <div class="buttons">
        <a href="{{route('home')}}" class="button is-danger">
            <i class="fa-solid fa-arrow-left"> </i> Regresar </a>
            <button href="{{ route('home') }}" class="button is-primary js-modal-trigger" data-target="modal-nvo-materia">
                <i class="fa-solid fa-chalkboard-user"></i>
                    Nueva materia
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
                
                <th class="has-text-centered">Clave Materia</th>
                <th class="has-text-centered">Nombre</th>
                <th class="has-text-centered">Creditos</th>
                <th class="has-text-centered">Opciones</th>
                
            </tr>
        </thead>

        <tbody>
            @foreach ($materias as $materia)
            <tr>
                <td class="has-text-centered" >{{$materia->clave_materia}}</td>
                <td class="has-text-centered">{{$materia->nombre}}</td>
                <td class="has-text-centered">{{$materia->creditos}}</td>
                
                
                <td>
                    <div class="field is-grouped">
                            
                        <button class="button is-warning has-text-white js-modal-trigger" data-target="modal-{{ $materia->id }}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                        <form action="{{ route('MateriasEliminar', $materia->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button is-danger"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar esta Materia?')">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                    </td>

                <!-- ======================= MODALES DE MODIFICAR PLAN ESTUDIO =====================================-->

                <div id="modal-{{ $materia->id }}" class="modal">
                    <div class="modal-background"></div>                
                        <div class="modal-content">
                            <div class="box">
                                <p class="title is-5 has-text-centered">Modificar Materias</p>
                                <form method="GET" action="{{ route('EditarMaterias', $materia->id) }}">
                                    <div class="field">
                                        <label class="label">Clave de materia:</label>
                                            <div class="control">
                                                <input class="input" type="text" name="txtClaveMateria" value="{{$materia->clave_materia}}">
                                            </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Nombre:</label>
                                            <div class="control">
                                                <input class="input" type="text" name="txtNombre" value="{{$materia->nombre }}"> 
                                            </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Creditos:</label>
                                            <div class="control">
                                                <input class="input" type="text" name="txtCreditos" value="{{$materia->creditos }}"> 
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
                        
            <div id="modal-nvo-materia" class="modal">
                <div class="modal-background"></div>
                    <div class="modal-content">
                        <div class="box">
                            <p class="title is-5 has-text-centered">Registrar Nueva Materia</p>
                            <form method="POST" action="{{ route('MateriasCrear', $materia->id) }}">
                                @csrf
                                @method('POST')
                                    <div class="field">
                                        <div class="control has-icons-left">
                                            <label class="label">Clave Materia:</label>
                                                <div class="control has-icons-left">
                                                    <input class="input" type="text" name = "txtClaveMateria" value="{{ old('txtClaveMateria') }}">
                                                    <span class="icon is-small is-left">
                                                        <i class="fa-solid fa-key"></i>
                                                    </span>
                                                </div>
                                        </div>
                                        @error('txtClaveMateria')
                                        <p class="help is-danger">Ingresa la clave de materia</p>
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
                                            <label class="label">Creditos:</label>
                                                <div class="control has-icons-left">
                                                    <input class="input" type="text" name = "txtCreditos" value="{{ old('txtCreditos') }}">
                                                    <span class="icon is-small is-left">
                                                        <i class="fa-solid fa-key"></i>
                                                    </span>
                                                </div>
                                        </div>
                                        @error('txtCreditos')
                                        <p class="help is-danger">Ingresa el credito</p>
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
        @if ($errors->has('txtRfc') || $errors->has('txtNombre') || $errors->has('txtAppaterno')
        || $errors->has('txtApmaterno') || $errors->has('txtCurp') || $errors->has('txtEmail'))
        <script>
            document.getElementById('modal-nvo-materia').classList.add('is-active');
        </script>
        @endif
    
    
            </td>
        <tr>
        
            
            
            
            
            
            
            @endforeach
        </tbody>
    </table>

    
</div>
@endsection