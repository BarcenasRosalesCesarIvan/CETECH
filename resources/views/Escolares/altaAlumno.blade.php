@extends('Layouts.plantilla')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/alta.css')}}">

    <title>altaAlumno</title>
</head>
<body>
 

    @section('content')

    <div class="container">
        
        <div class="columns">
            <div class="column is-half is-offset-one-quarter  ">
                <div class="box">
                    <h1 class="title is-5">Datos Personales</h1>
                    <div class="field">
                        <label class="label">Nombre</label>
                        <div class="control has-icons-left">
                            <span class="icon is-small is-left">
                                <i class='bx bxs-envelope'></i>
                            </span>
                            <input class="input" type="email" placeholder="Juan/Ivan">
                        </div>
                        <label class="label">Apellidos</label>
                        <div class="control has-icons-left">
                            <span class="icon is-small is-left">
                                <i class='bx bxs-envelope'></i>
                            </span>
                            <input class="input" type="email" placeholder="Juan/Ivan">
                        </div>
                    </div>              
                </div>
            </div>         
        </div>

        <div class="columns">
            <div class="column is-half is-offset-one-quarter  ">
                <div class="box">
                    <h1 class="title is-5">Datos Academicos</h1>
                    <div class="field">
                        <label class="label">Carrera</label>
                        <div class="control has-icons-left">
                            <span class="icon is-small is-left">
                                <i class='bx bxs-envelope'></i>
                            </span>
                            <input class="input" type="email" placeholder="IND/ISIC/IELEM">
                        </div>
                        <label class="label">Seemestre</label>
                        <div class="control has-icons-left">
                            <span class="icon is-small is-left">
                                <i class='bx bxs-envelope'></i>
                            </span>
                            <input class="input" type="email" placeholder="1-12">
                        </div>
                    </div>              
                </div>
            </div>         
        </div>

        <div class="columns">
            <div class="column is-half is-offset-one-quarter  ">
                <div class="box">
                    <h1 class="title is-5">Datos de Contacto</h1>
                    <div class="field">
                        <label class="label">Dirección</label>
                        <div class="control has-icons-left">
                            <span class="icon is-small is-left">
                                <i class='bx bxs-envelope'></i>
                            </span>
                            <input class="input" type="email" placeholder="Tecnologico #22, Zona central">
                        </div>
                        <label class="label">Cod.Postal</label>
                        <div class="control has-icons-left">
                            <span class="icon is-small is-left">
                                <i class='bx bxs-envelope'></i>
                            </span>
                            <input class="input" type="email" placeholder="76804">
                        </div>
                    </div>              
                </div>
            </div>         
        </div>
        
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                <div class=" Botones">
                    <a href="{{route('escolaresAlumnos')}}" class="button is-danger centraBoton">Regresar</a>
                    <a href="{{route('escolaresAlumnos')}}" class="button is-success centraBoton">Guardar</a>
                </div>
                    
                
                    
                
            </div>
        </div>




    
<!-- Este es la parte del Div container -->

</div>

    @endsection
    
</body>
</html>