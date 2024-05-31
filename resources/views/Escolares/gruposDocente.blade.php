@extends('Layouts.plantilla')
@section('content')

<div class="box">
    <h1 class="title is-3 has-text-centered">Grupos de {{$user->name}}</h1>
    <div class="buttons">
        <a href="{{route('home')}}" class="button is-danger">
            <i class="fa-solid fa-arrow-left"></i> Regresar
        </a>
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
                <th class="has-text-centered">Periodo</th>
                <th class="has-text-centered">Plan de Estudio</th>
                <th class="has-text-centered">Materia</th>
                <th class="has-text-centered">Grupo</th>
                <th class="has-text-centered">Capacidad</th>
                <th class="has-text-centered">Opción</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($result as $item)
            <tr>
                <td>
                    @foreach ($periodos as $i)
                    {{ $item->periodo_id=== $i->id ? $i->nombre_periodo : '' }}
                    @endforeach
                </td>
                <td>
                    @foreach ($planes as $i)
                    {{ $item->planEstudio_id=== $i->id ? $i->clave_plan_estudio : '' }}
                    @endforeach
                </td>
                <td>
                    @foreach ($materias as $i)
                    {{ $item->materia_id=== $i->id ? $i->nombre : '' }}
                    @endforeach
                </td>
                <td class="has-text-centered">{{$item->letra_grupo}}</td>
                <td class="has-text-centered">{{$item->capacidad}}</td>
                <td>
                    <div class="field is-grouped">
                        <form action="{{ route('alumnosDocente', [ 'planEstudio_id' => $item->planEstudio_id]) }}" method="GET">
                            
                           
                            <input type="hidden" name="txtPlan" value="{{ $item->planEstudio_id }}">
                            <button type="submit" class="button is-link has-text-white">
                               <p class="is-size-7 has-text-black"> <i class="fa-solid fa-book"> Ver</i></p>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
           
            @endforeach
        </tbody>
    </table>
</div>
@endsection
