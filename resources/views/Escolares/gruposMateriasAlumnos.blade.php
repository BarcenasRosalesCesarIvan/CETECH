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


    <h1 class="title is-3 has-text-centered">Materias Inscritas</h1>
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
                
                <th class="has-text-centered">Periodo</th>
                <th class="has-text-centered">Plan de Estudio</th>
                <th class="has-text-centered">Materia</th>
                <th class="has-text-centered">Grupo</th>
                
                
               
                
                
            </tr>
        </thead>

        <tbody>
            @foreach ($grupo  as $item)
            <tr>
                <td>
                    @foreach ($periodos as $i)
                    {{ $item->periodo_id=== $i->id ? $i->nombre_periodo : '' }}
                    @endforeach
                </td>
                <td>
                    @foreach ($planes as $i)
                    {{ $item->planEstudio_id=== $i->id ? $i->carrera : '' }}
                    @endforeach
                </td>
                <td>
                    @foreach ($materias as $i)
                    {{ $item->materia_id=== $i->id ? $i->nombre : '' }}
                    @endforeach
                </td>
                
                <td class="has-text-centered">{{$item->letra_grupo}}</td>
                

               

             
                   


                                    


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