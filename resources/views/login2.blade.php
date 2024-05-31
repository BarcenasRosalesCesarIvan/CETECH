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
    
    <div class="container is-fluid">
        
        <div class="columns is-centered is-vcentered" style="height: 100vh;">
            <div class="column is-4">
                <div class="box">
                    <figure class="image is-96x96">
                        <div class="has-text-centered">
                        <img  class="is-rounded is-" src="IMG\LT.PNG" alt="">
                        </div>
                    </figure>
                    <h1 class="title is-5">Sistema Integral de Informacion</h1>
                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="field">
                        <label class="label">Correo Institucional</label>
                        <div class="control has-icons-left">
                            <span class="icon is-small is-left">
                                <i class='bx bxs-envelope'></i>
                            </span>
                            <input class="input" type="email" placeholder="l20590233@sjuanrio.tecnm.mx">
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $hola }}</strong>
                        </span>
                         @enderror
                        <label class="label">Contraseña</label>
                        <div class="control has-icons-left">
                            <span class="icon is-small is-left">
                                <i class='bx bxs-lock'></i>
                            </span>
                            <input class="input" type="password" placeholder="Password">
                        </div> 
                        <div class="buttons has-addons is-centered">
                           
                            < href="{{route('home')}}" class="button is-primary">Ir a Home</>
                           
                          </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>