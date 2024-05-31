<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= <div class="box">
</head>


        <h1 class="title is-3 has-text-centered"> Salones</h1>
        <div class="buttons">
            <a href="{{route('home')}}" class="button is-danger">
                <i class="fa-solid fa-arrow-left"> </i> Regresar </a>
                <button href="{{ route('home') }}" class="button is-primary js-modal-trigger" data-target="modal-nvo-plan">
                    <i class="fa-solid fa-building"></i>
                        Agregar nuevo Salon
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
                    
                    <th class="has-text-centered">Salon</th>
                    <th class="has-text-centered">Edificio</th>
                    <th class="has-text-centered">Opciones</th>
                    
                </tr>
            </thead>
            
    
            <tbody>
                @foreach ($salon as $item)
                <tr>
                    <td class="has-text-centered" >{{$item->nombre_salon}}</td>
                    <td class="has-text-centered">{{$item->edificio_id}}</td>
                    
                    
                    <td>
                        <div class="field is-grouped">
                                
                            <button class="button is-warning has-text-white js-modal-trigger" data-target="modal-{{ $item->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
    
                            <form action="{{ route('EdificioEliminar', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button is-danger"
                                    onclick="return confirm('¿Estás seguro de que quieres eliminar este Edificio?')">
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
                                    <p class="title is-5 has-text-centered">Modificar Edificio</p>
                                    <form method="GET" action="{{ route('EditarEdificio', $item->id) }}">
                                        <div class="field">
                                            <label class="label">Nombre de Edificio:</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="txtNombreEdificio" value="{{$item->nombre_edificio }}">
                                                </div>
                                        </div>
                                        <div class="field">
                                            <label class="label">Descripcion:</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="txtDescripcion" value="{{$item->descripcion }}"> 
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
                                <p class="title is-5 has-text-centered">Agregar Nuevo Edificio</p>
                                <form method="POST" action="{{ route('EdificiosCrear', $item->id) }}">
                                    @csrf
                                    @method('POST')
                                        <div class="field">
                                            <div class="control has-icons-left">
                                                <label class="label">Nombre Edificio:</label>
                                                    <div class="control has-icons-left">
                                                        <input class="input" type="text" name = "txtNombreEdificio" value="{{ old('txtNombreEdificio') }}">
                                                        <span class="icon is-small is-left">
                                                            <i class="fa-solid fa-key"></i>
                                                        </span>
                                                    </div>
                                            </div>
                                            @error('txtNombreEdificio')
                                            <p class="help is-danger">Ingresa el nombre de edificio</p>
                                            @enderror
                                        </div>
    
                                        <div class="field">
                                            <div class="control has-icons-left">
                                                <label class="label">Descripción:</label>
                                                    <div class="control has-icons-left">
                                                        <input class="input" type="text" name = "txtDescripcion" value="{{ old('txtDescripcion') }}">
                                                        <span class="icon is-small is-left">
                                                            <i class="fa-solid fa-key"></i>
                                                        </span>
                                                    </div>
                                            </div>
                                            @error('txtDescripcion')
                                            <p class="help is-danger">Ingresa el Nombre</p>
                                            @enderror
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
    
        
    </div> , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

<body>
    
</body>
</html>