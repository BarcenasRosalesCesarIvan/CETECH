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
                <div class="column  ">
                    <div class="box">
                        <h1 class="title is-5 "><i class="fa-solid fa-address-card"></i> Lista de Alumnos</h1>
                        <p>Visualizar lista de alumnos.</p>
                        <br>
                        <a href="{{route('escolaresAlumnos')}}" class="button is-info">Acceder</a>
                    </div>
                </div>
                <div class="column  ">
                    <div class="box">
                        <h1 class="title is-5 "><i class="fa-solid fa-address-card"></i> Alumno-s</h1>
                        <p>Modifica tus alumnos.</p>
                        <br>
                        <a href="{{route('login')}}" class="button is-info">Acceder</a>
                    </div>
                </div>
                <div class="column  ">
                    <div class="box">
                        <h1 class="title is-5 "><i class="fa-solid fa-address-card"></i> Datos Personales</h1>
                        <p>Modifica tus datos personales.</p>
                        <br>
                        <a href="{{route('escolaresAlumnos')}}" class="button is-info">Acceder</a>
                    </div>
                </div>
    
            </div>

            <!-- Inicia otro sector de columnas     -->
            <div class="columns">
                <div class="column  ">
                    <div class="box">
                        <h1 class="title is-5 "><i class="fa-solid fa-address-card"></i> Datos Personales</h1>
                        <p>Modifica tus datos personales.</p>
                        <br>
                        <a href="{{route('login')}}" class="button is-info">Acceder</a>
                    </div>
                </div>
                <div class="column  ">
                    <div class="box">
                        <h1 class="title is-5 "><i class="fa-solid fa-address-card"></i> Datos Personales</h1>
                        <p>Modifica tus datos personales.</p>
                        <br>
                        <a href="{{route('login')}}" class="button is-info">Acceder</a>
                    </div>
                </div>
                <div class="column  ">
                    <div class="box">
                        <h1 class="title is-5 "><i class="fa-solid fa-address-card"></i> Datos Personales</h1>
                        <p>Modifica tus datos personales.</p>
                        <br>
                        <a href="{{route('login')}}" class="button is-info">Acceder</a>
                    </div>
                </div>
    
            </div>

                <!-- Inicia otro sector de columnas     -->
                <div class="columns ">
                    <div class="column is-one-third ">
                        <div class="box">
                            <h1 class="title is-5 "><i class="fa-solid fa-address-card"></i> Datos Personales</h1>
                            <p>Modifica tus datos personales.</p>
                            <br>
                            <a href="{{route('login')}}" class="button is-info">Acceder</a>
                        </div>
                    </div>
                
                </div>   
                
            </div>
        </div>

    <!--<a href="{{route('login')}}" class="button is-primary">Ir a Login</a>-->

    
    @endsection
</body>
</html>