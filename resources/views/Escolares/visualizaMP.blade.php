@extends('Layouts.plantilla')
@section('content')

<div class="box">


    <h1 class="title is-3 has-text-centered">Materias relacionadas a {{$ca}}  

       
        

    </h1>
    
    <div class="buttons">
        <a href="{{route('escolaresPlanEstudio')}}" class="button is-danger">
            <i class="fa-solid fa-arrow-left"> </i> Regresar </a>
            <button href="{{ route('home') }}" class="button is-primary js-modal-trigger" data-target="modal-nvo-plan">
                <i class="fa-solid fa-chalkboard-user"></i>
                  Asignar Materia a Plan
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
                
                <th class="has-text-centered">Materia Id</th>
                <th class="has-text-centered">Plan de Estudio</th>
                <th class="has-text-centered">Creditos</th>
                
                <th class="has-text-centered">Opción</th>
                
            </tr>
        </thead>

        

        <tbody>
            @foreach ($result as $item)
            <tr>
                 <td>
                    @foreach ($materias as $i)
                    {{ $item->materia_id === $i->id ? $i->nombre : '' }}
                    @endforeach
                </td>
                
                

                <td>
                    @foreach ($planes as $p)
                    {{ $item->plan_estudio_id === $p->id ? $p->clave_plan_estudio : '' }}
                    @endforeach  
                </td>
                <td>
                    @foreach ($materias as $i)
                    {{ $item->materia_id === $i->id ? $i->creditos : '' }}
                    @endforeach
                </td>
                    
  
                <td>
                    <div class="field is-grouped">
                        <form action="{{ route('MPEliminar', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button is-danger"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar esta materia y plan de estudios?')">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </td>
                
                 <!--======================= MODAL DE AGREGAR NUEVO  REGISTRO=================-->
                        
            <div id="modal-nvo-plan" class="modal">
                <div class="modal-background"></div>
                    <div class="modal-content">
                        <div class="box">
                            <p class="title is-5 has-text-centered">Registrar Nueva Materia con Plan</p>
                            <form method="POST" action="{{ route('MPCrear', $item->id) }}">
                                @csrf
                                @method('POST')
                                
                                <div class="field">
                                    <label class="label">Claves de  Materias:</label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="txtMateria" id="">
                                                   
                                                    

                                                    @foreach($materias as $mat)
                                                        <option value="{{$mat->id}}" {{ $mat->id == $item->materia_id ? 'selected' : ' '  }}  > {{$mat->nombre}}</option>
                                                        
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                        </div>
                                </div>


                                <div class="field">
                                    
                                        <div class="control">
                                            <div class=""></div>
                                            <input type="hidden" name="txtPlan" value="{{$clave}}">

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
        || $errors->has('txtApmaterno') || $errors->has('txtCurp') || $errors->has('txtEmail'))
        <script>
            document.getElementById('modal-nvo-plan').classList.add('is-active');
        </script>
        @endif



                
             <tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection