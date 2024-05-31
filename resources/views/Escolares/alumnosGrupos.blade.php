@extends('Layouts.plantilla')
@section('content')

<div class="box">
    <h1 class="title is-3 has-text-centered">Gestión de Alumnos</h1>
    <div class="buttons">
        <a href="{{route('home')}}" class="button is-danger">
            <i class="fa-solid fa-arrow-left"></i> Regresar
        </a>
        <button href="{{ route('home') }}" class="button is-primary js-modal-trigger" data-target="modal-nvo-alumno">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                Nuevo Alumno
        </button>
    </div>

    @if (session('Correcto'))
    <div class="notification has-text-centered is-success is-light">
        <button class="delete"></button>
        {{session('Correcto')}}
    </div>
    @endif

    @if (session('Incorrecto'))
    <div class="notification has-text-centered is-danger is-light">
        <button class="delete"></button>
        {{session('Incorrecto')}}
    </div>
    @endif

    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th class="has-text-centered">No control</th>
                <th class="has-text-centered">Apellidos</th>
                <th class="has-text-centered">Nombres</th>
                <th class="has-text-centered">Semestre</th>
                
                
                <th class="has-text-centered">Opción</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($result as $item)
            <tr>
               
                <td class="has-text-centered">{{$item->numero_de_control}}</td>
                <td class="has-text-centered">{{$item->ap_paterno}}</td>
                <td class="has-text-centered">{{$item->nombre}}</td>
                <td class="has-text-centered">{{$item->semestre}}</td>
                
                <td>
                    <div class="field is-grouped">
                            
                        

                        <form action="{{ route('AlumnosEliminar', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button is-danger"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar este Alumno?')">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>


                     <!--======================= MODAL DE AGREGAR NUEVO  REGISTRO=================-->
                        
            <div id="modal-nvo-alumno" class="modal">
                <div class="modal-background"></div>
                    <div class="modal-content">
                        <div class="box">
                            <p class="title is-5 has-text-centered">Registrar Nuevo Alumno</p>
                            <form method="POST" action="{{ route('escolaresAlumnosCrear', $item->id) }}">
                                @csrf
                                @method('POST')
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <label class="label">Numero de control:</label>
                                            <div class="control has-icons-left">
                                                <input class="input" type="text" name = "txtNumber" value="{{ old('txtNumber') }}">
                                                <span class="icon is-small is-left">
                                                    <i class="fa-solid fa-key"></i>
                                                </span>
                                            </div>
                                    </div>
                                    @error('txtClaveMateria')
                                    <p class="help is-danger">Ingresa la clave de materia</p>
                                    @enderror
                                </div>

                                <div class="field is-hidden">
                                    <label class="label">Nombre:</label>
                                        <div class="control">
                                            <input class="input" type="text" name="txtNombre" value="{{$item->nombre }}">
                                        </div>
                                </div>
                                      

                                <div class="field is-hidden">
                                    <label class="label">Apellido Paterno:</label>
                                        <div class="control">
                                            <input class="input" type="text" name="txtAPPaterno" value="{{$item->ap_paterno }}">
                                        </div>
                                </div>

                                <div class="field is-hidden">
                                    <label class="label">Apellido Materno:</label>
                                        <div class="control">
                                            <input class="input" type="text" name="txtAPMaterno" value="{{$item->ap_materno }}">
                                        </div>
                                </div>

                                <div class="field">
                                    <label class="label">Curp:</label>
                                        <div class="control">
                                            <input class="input" type="text" name="txtCurp" value="{{$item->curp }}">
                                        </div>
                                </div>

                                <div class="field is-hidden">
                                    <label class="label">Plam de estudio:</label>
                                        <div class="control">
                                            <input class="input" type="text" name="txtPlan" value="{{$item->plan_estudio_id }}">
                                        </div>
                                </div>

                                <div class="field is-hidden">
                                    <label class="label">Semestre:</label>
                                        <div class="control">
                                            <input class="input" type="text" name="txtSemestre" value="{{$item->semestre }}">
                                        </div>
                                </div>

                                <div class="field is-hidden">
                                    <label class="label">Estatus:</label>
                                        <div class="control">
                                            <input class="input" type="text" name="txtEstatus" value="{{$item->estatus_id }}">
                                        </div>
                                </div>

                                <div class="field">
                                    <label class="label">Tipo de alumno:</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select name="txtTipo">
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
                                               
                                            </select>
                                        </div>
                                    </div>
                                    @error('txtTipo')
                                    <p class="help is-danger">Ingresa el Semestre</p>
                                    @enderror
                                </div>


                                <div class="field">
                                    <label class="label">User:</label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="txtUser" id="">
                                                   
                                                    @foreach($usuarios as $usuario)
                                                        <option value="{{$usuario->id}}" {{ $usuario->id == $item->user_id ? 'selected' : ' '  }}  > {{$usuario->name}}</option>
                                                        
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
            </tr>
           
            @endforeach
        </tbody>
    </table>
</div>
@endsection
