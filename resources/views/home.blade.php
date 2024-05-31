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
            <div class="columns">
                @hasrole('escolares')

                   
                
                <div class="column">
                    <div class="box">
                        <h1 class="title is-5"><i class="fa-solid fa-address-card"></i> Alumnos</h1>
                        <p>Ver, crear, editar alumnos.</p>
                        <br>
                        <a href="{{route('escolaresAlumnos')}}" class="button is-info">Acceder</a>
                    </div>
                </div>
                <div class="column">
                    <div class="box">
                        <h1 class="title is-5"><i class="fa-solid fa-address-card"></i> Docentes</h1>
                        <p>Ver, crear, editar docentes.</p>
                        <br>
                        <a href="{{route('escolaresDocentes')}}" class="button is-info">Acceder</a>
                    </div>
                </div>
                <div class="column">
                    <div class="box">
                        <h1 class="title is-5"><i class="fa-solid fa-address-card"></i> Grupos</h1>
                        <p>Ver, crear, editar grupos.</p>
                        <br>
                        <a href="{{route('escolaresGrupos')}}" class="button is-info">Acceder</a>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column is-one-third">
                    <div class="box">
                        <h1 class="title is-5"><i class="fa-solid fa-address-card"></i> Edificios y Salones</h1>
                        <p>Ver, crear, editar edificios y salones.</p>
                        <br>
                        <a href="{{route('escolaresEdificios')}}" class="button is-info">Acceder</a>
                    </div>
                </div>
                <div class="column is-one-third">
                    <div class="box">
                        <h1 class="title is-5"><i class="fa-solid fa-address-card"></i> Periodos</h1>
                        <p>Ver, crear, editar periodos.</p>
                        <br>
                        <a href="{{route('escolaresPeriodos')}}" class="button is-info">Acceder</a>
                    </div>
                </div>
                @endhasrole

                @hasrole('division')
                <div class="column">
                    <div class="box">
                        <h1 class="title is-5"><i class="fa-solid fa-address-card"></i> Materias</h1>
                        <p>Ver, crear, editar materias.</p>
                        <br>
                        <a href="{{ route('escolaresMaterias') }}" class="button is-info">Acceder</a>
                    </div>
                </div>
                <div class="column">
                    <div class="box">
                        <h1 class="title is-5"><i class="fa-solid fa-address-card"></i> Planes de Estudio</h1>
                        <p>Ver, crear, editar planes de estudio.</p>
                        <br>
                        <a href="{{ route('escolaresPlanEstudio') }}" class="button is-info">Acceder</a>
                    </div>
                </div>
                <div class="column">
                    <div class="box">
                        <h1 class="title is-5"><i class="fa-solid fa-address-card"></i> Asignar Materias a Planes</h1>
                        <p>Asignar materias a Planes de Estudio.</p>
                        <br>
                        <a href="{{ route('escolaresMateriaPlanEstudio') }}" class="button is-info">Acceder</a>
                    </div>
                </div>



             
                @endhasrole
            </div>

            <!-- Inicia otro sector de columnas -->
            <div class="columns">
               
               
               

                @hasrole('docente')

                <div class="column">
                    <div class="box">
                        <h1 class="title is-5"><i class="fa-solid fa-address-card"></i> Listas</h1>
                        <p>Grupos asignados al docente</p>
                        <br>

                        <form action="{{ route('gruposDocente', ['id' => $user->id, 'name' => $user->name]) }}" method="GET">                            
                            <button type="submit" class="button is-info has-text-white">
                                <a class="button is-info">Acceder</a>
                            </button>
                        </form>
                        
                    </div>
                </div>

                <div class="column">
                    <div class="box">
                        <h1 class="title is-5"><i class="fa-solid fa-address-card"></i> Calificaciones</h1>
                        <p>Subir calificaciones.</p>
                        <br>
                        <a class="button is-info">Acceder</a>
                    </div>
                </div>
                
               
                @endhasrole


                @hasrole('alumnos')


                <div class="column is-one-third">
                    <div class="box">
                        <h1 class="title is-5"><i class="fa-solid fa-address-card"></i> Materias cargadas</h1>
                        <p>Materias asignadas al Alumno</p>
                        <br>

                        <form action="{{ route('gruposMateriasAlumnos', ['id' => $user->id, 'name' => $user->name]) }}" method="GET">                            
                            <button type="submit" class="button is-info has-text-white">
                                <a class="button is-info">Acceder</a>
                            </button>
                        </form>
                        
                    </div>
                </div>

               
                @endhasrole




            </div>
        </div>
    @endsection
</body>
</html>
