@extends('Layouts.plantilla')
@section('content')

<div class="box">


    <h1 class="title is-3 has-text-centered">Periodos</h1>
    <div class="buttons">
        <a href="{{route('home')}}" class="button is-danger">
            <i class="fa-solid fa-arrow-left"> </i> Regresar </a>
            <button href="{{ route('home') }}" class="button is-primary js-modal-trigger" data-target="modal-nvo-periodo">
                <i class="fa-solid fa-chalkboard-user"></i>
                    Nuevo Periodo
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
                
                <th class="has-text-centered">Clave Periodo</th>
                <th class="has-text-centered">Nombre Periodo</th>
                <th class="has-text-centered">Estatus</th>
                <th class="has-text-centered">Opciones</th>
                
            </tr>
        </thead>

        <tbody>
            @foreach ($periodos as $periodo)
            <tr>
                <td class="has-text-centered" >{{$periodo->clave_periodo}}</td>
                <td class="has-text-centered">{{$periodo->nombre_periodo}}</td>
                <td class="has-text-centered">{{$periodo->estatus}}</td>
                
                
                <td>
                    <div class="field is-grouped">
                            
                        <button class="button is-warning has-text-white js-modal-trigger" data-target="modal-{{ $periodo->id }}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                        <form action="{{ route('PeriodosEliminar', $periodo->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button is-danger"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar este Periodo?')">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                    </td>

                <!-- ======================= MODALES DE MODIFICAR PLAN ESTUDIO =====================================-->

                <div id="modal-{{ $periodo->id }}" class="modal">
                    <div class="modal-background"></div>                
                        <div class="modal-content">
                            <div class="box">
                                <p class="title is-5 has-text-centered">Modificar Periodo</p>
                                <form method="GET" action="{{ route('EditarPeriodos', $periodo->id) }}">

                                    
                                    

                                    <div class="field">
                                        <label class="label">Año:</label>
                                        <div class="control">
                                            <div class="select is-fullwidth">
                                                <select name="txtYear">
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        @error('txtYear')
                                        <p class="help is-danger">Año:</p>
                                        @enderror
                                    </div>
    
                                    <div class="field">
                                        <label class="label">Periodo:</label>
                                        <div class="control">
                                            <div class="select is-fullwidth">
                                                <select name="txtOpcionesPeriodo">
                                                    <option value="Enero-Junio">Enero - Junio</option>
                                                    <option value="Agosto-Diciembre">Agosto - Diciembre</option>
                                                    <option value="Verano">Verano</option>
                                                </select>
                                            </div>
                                        </div>
                                        @error('txtNombrePeriodo')
                                        <p class="help is-danger">Ingresa el Nombre del periodo</p>
                                        @enderror
                                    </div>
    
                                        <div class="field">
                                            <label class="label">Estatus:</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="txtEstatus">
                                                        <option value="Cerrado">Cerrado</option>
                                                        <option value="En Curso">En Curso</option>
                                                        <option value="En Preparación">En Preparación</option>
                                                    </select>
                                                </div>
                                            </div>
                                            @error('txtEstatus')
                                            <p class="help is-danger">Selecciona un estatus</p>
                                            @enderror
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
                        
            <div id="modal-nvo-periodo" class="modal">
                <div class="modal-background"></div>
                    <div class="modal-content">
                        <div class="box">
                            <p class="title is-5 has-text-centered">Registrar Nuevo Periodo</p>
                            <form method="POST" action="{{ route('PeriodosCrear', $periodo->id) }}">
                                @csrf
                                @method('POST')

                                <div class="field">
                                    <label class="label">Año del  Periodo:</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select name="txtYear">
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    @error('txtYear')
                                    <p class="help is-danger">Año:</p>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label class="label">Periodo:</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select name="txtOpcionesPeriodo">
                                                <option value="Enero-Junio">Enero - Junio</option>
                                                <option value="Agosto-Diciembre">Agosto - Diciembre</option>
                                                <option value="Verano">Verano</option>
                                            </select>
                                        </div>
                                    </div>
                                    @error('txtNombrePeriodo')
                                    <p class="help is-danger">Ingresa el Nombre del periodo</p>
                                    @enderror
                                </div>

                                    <div class="field">
                                        <label class="label">Estatus:</label>
                                        <div class="control">
                                            <div class="select is-fullwidth">
                                                <select name="txtEstatus">
                                                    <option value="Cerrado">Cerrado</option>
                                                    <option value="En Curso">En Curso</option>
                                                    <option value="En Preparación">En Preparación</option>
                                                </select>
                                            </div>
                                        </div>
                                        @error('txtEstatus')
                                        <p class="help is-danger">Selecciona un estatus</p>
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