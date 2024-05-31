
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="CSS/estilo.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <title>Document</title>
</head>
<body>
    @extends('Layouts.plantilla')
    @section('content')
    <div class="container is-fluid">
        <div class="columns is-centered is-vcentered" style="height: 100vh;">
            <div class="column is-4">
                <div class="box">
                    <div class="has-text-centered">
                        <figure class="image is-128x128 is-inline-block">
                            <img class="is-rounded" src="IMG/LT.png">
                        </figure>
                        
                    </div>
                    <br>
                    <div class="columns is-centered mt-4">
                        <div class="column is-narrow">
                            <h1 class="title is-5 ">Sistema Integral de Información</h1>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="field">
                            <label class="label">Correo Institucional</label>
                            <div class="control has-icons-left has-icons-right">
                                
                                <span class="icon is-small is-left">
                                    <i class='bx bxs-envelope'></i>
                                </span>
                                <input  name='email' class="input is-rounded " type="email" placeholder="l20590230@sjuanrio.tecnm.mx">
                            </div>
                            <p class="help is-success">Este correo es disponible</p>
                            @error('email')
                                <p class="help is-danger">{{ $message }}</p>         
                            @enderror
                        </div>
                        
                        <div class="field ">
                            <label class="label">Contraseña</label>
                            <div class="control has-icons-left">
                                <span class="icon is-small is-left">
                                    <i class='bx bx-lock-alt' ></i>
                                </span>
                                
                                <input name='password' class="input is-rounded" type="password" placeholder="Password">
                                <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                                
                            </div>
                            @error('password')
                                <p class="help is-danger">{{ $message }}</p>
                         
                            @enderror
                        </div>
                        <div class="columns is-centered mt-2">
                            <div class="column is-narrow">
                                <button class="button is-primary is-rounded is-medium has-shadow" type="submit">
                                    <span class="icon">
                                        <i class='bx bxs-pyramid'></i> <!-- Puedes cambiar el icono aquí -->
                                    </span>
                                    <span>Iniciar Sesión</span>
                                </button>
                            </div>
                        </div>
                        
                        
                    
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>

</html>