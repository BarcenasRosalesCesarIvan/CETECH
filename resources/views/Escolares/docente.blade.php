@extends('Layouts.plantilla')
@section('content')

<div class="box">


    <h1 class="title is-3 has-text-centered">Docentes</h1>
    <div class="buttons">
        <a href="{{route('home')}}" class="button is-danger">
            <i class="fa-solid fa-arrow-left"> </i> Regresar </a>
            <button href="{{ route('home') }}" class="button is-primary js-modal-trigger" data-target="modal-nvo-plan">
                <i class="fa-solid fa-chalkboard-user"></i>
                    Nuevo Docente
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
                
                <th class="has-text-centered">RFC</th>
                <th class="has-text-centered">Nombre</th>
                <th class="has-text-centered">Ap Paterno</th>
                <th class="has-text-centered">Ap Materno</th>
                <th class="has-text-centered">Curp</th>
                <th class="has-text-centered">Email</th>
                <th class="has-text-centered">Opciones</th>
                
            </tr>
        </thead>

        <tbody>
            @foreach ($planes as $item)
            <tr>
                <td class="has-text-centered" >{{$item->rfc}}</td>
                <td class="has-text-centered">{{$item->nombre}}</td>
                <td class="has-text-centered">{{$item->ap_paterno}}</td>
                <td class="has-text-centered">{{$item->ap_materno}}</td>
                <td class="has-text-centered">{{$item->curp}}</td>
                <td class="has-text-centered">{{$item->email}}</td>
                
                <td>
                    <div class="field is-grouped">
                            
                        <button class="button is-warning has-text-white js-modal-trigger" data-target="modal-{{ $item->id }}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                        <form action="{{ route('DocenteEliminar', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button is-danger"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar este Docente?')">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                    </td>

                <!-- ======================= MODALES DE MODIFICAR PLAN ESTUDIO =====================================-->

                <div id="modal-{{ $item->id }}" class="modal">
                    <div class="modal-background"></div>                
                        <div class="modal-content">
                            <div class="box">
                                <p class="title is-5 has-text-centered">Modificar Docentes</p>
                                <form method="GET" action="{{ route('EditarDocentes', $item->id) }}">
                                    <div class="field">
                                        <label class="label">RFC:</label>
                                            <div class="control">
                                                <input class="input" type="text" name="txtRfc" value="{{$item->rfc }}">
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
                                                <input class="input" type="text" name="txtAppaterno" value="{{$item->ap_paterno }}"> 
                                            </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Ap Materno</label>
                                            <div class="control">
                                                <input class="input" type="text" name="txtApmaterno" value="{{$item->ap_materno }}"> 
                                            </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Curp:</label>
                                            <div class="control">
                                                <input class="input" type="text" name="txtCurp" value="{{$item->curp }}"> 
                                            </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Email:</label>
                                            <div class="control">
                                                <input class="input" type="text" name="txtEmail" value="{{$item->email }}"> 
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
                        
            <div id="modal-nvo-plan" class="modal">
                <div class="modal-background"></div>
                    <div class="modal-content">
                        <div class="box">
                            <p class="title is-5 has-text-centered">Registrar Nuevo Docente</p>
                            <form method="POST" action="{{ route('DocentesCrear', $item->id) }}">
                                @csrf
                                @method('POST')
                                    <div class="field">
                                        <div class="control has-icons-left">
                                            <label class="label">RFC:</label>
                                                <div class="control has-icons-left">
                                                    <input class="input" type="text" name = "txtRfc" value="{{ old('txtRfc') }}">
                                                    <span class="icon is-small is-left">
                                                        <i class="fa-solid fa-key"></i>
                                                    </span>
                                                </div>
                                        </div>
                                        @error('txtClave')
                                        <p class="help is-danger">Ingresa el RFC</p>
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
                                        @error('txtClave')
                                        <p class="help is-danger">Ingresa el Nombre</p>
                                        @enderror
                                    </div>

                                    <div class="field">
                                        <div class="control has-icons-left">
                                            <label class="label">Ap Paterno:</label>
                                                <div class="control has-icons-left">
                                                    <input class="input" type="text" name = "txtAppaterno" value="{{ old('txtAppaterno') }}">
                                                    <span class="icon is-small is-left">
                                                        <i class="fa-solid fa-key"></i>
                                                    </span>
                                                </div>
                                        </div>
                                        @error('txtClave')
                                        <p class="help is-danger">Ingresa el Ap Paterno</p>
                                        @enderror
                                    </div>

                                    <div class="field">
                                        <div class="control has-icons-left">
                                            <label class="label">Ap Materno:</label>
                                                <div class="control has-icons-left">
                                                    <input class="input" type="text" name = "txtApmaterno" value="{{ old('txtApmaterno') }}">
                                                    <span class="icon is-small is-left">
                                                        <i class="fa-solid fa-key"></i>
                                                    </span>
                                                </div>
                                        </div>
                                        @error('txtClave')
                                        <p class="help is-danger">Ingresa el Ap Materno</p>
                                        @enderror
                                    </div>

                                    <div class="field">
                                        <div class="control has-icons-left">
                                            <label class="label">Curp:</label>
                                                <div class="control has-icons-left">
                                                    <input class="input" type="text" name = "txtCurp" value="{{ old('txtCurp') }}">
                                                    <span class="icon is-small is-left">
                                                        <i class="fa-solid fa-key"></i>
                                                    </span>
                                                </div>
                                        </div>
                                        @error('txtClave')
                                        <p class="help is-danger">Ingresa el Curp</p>
                                        @enderror
                                    </div>

                                    <div class="field">
                                        <div class="control has-icons-left">
                                            <label class="label">Email:</label>
                                                <div class="control has-icons-left">
                                                    <input class="input" type="text" name = "txtEmail" value="{{ old('txtEmail') }}">
                                                    <span class="icon is-small is-left">
                                                        <i class="fa-solid fa-key"></i>
                                                    </span>
                                                </div>
                                        </div>
                                        @error('txtClave')
                                        <p class="help is-danger">Ingresa el Email</p>
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