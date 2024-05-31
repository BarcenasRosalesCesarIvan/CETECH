@extends('Layouts.plantilla')
@section('content')

<div class="box">


    <h1 class="title is-3 has-text-centered">Alumnos

       
        

    </h1>
    
    <div class="buttons">
        <a href="{{route('home')}}" class="button is-danger">
            <i class="fa-solid fa-arrow-left"> </i> Regresar </a>
            
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
                
                <th class="has-text-centered">No. Control</th>
                <th class="has-text-centered">Apellidos</th>
                <th class="has-text-centered">Nombres</th>
                <th class="has-text-centered">Semestre</th>
                
                
            </tr>
        </thead>

        

        <tbody>
            @foreach ($alumno as $item)
            <tr>
                
                <td class="has-text-centered" >{{$item->numero_de_control}}</td>
                <td class="has-text-centered" >{{$item->ap_paterno}}</td>
                <td class="has-text-centered" >{{$item->nombre}}</td>
                <td class="has-text-centered" >{{$item->semestre}}</td>

                   
                </td>
                
               
            @endforeach
        </tbody>
    </table>

</div>
@endsection