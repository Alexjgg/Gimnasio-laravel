<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>AsNevesFit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- style bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Estilos de AsnevesFit --->
    <link rel="stylesheet" href="{{ asset('/resources/css/asnevesfit.css') }}">
</head>

<body>
    <header>
        <nav class="menu">
            <label class="logo">AsNevesFit</label>
            <ul class="menu_items">
                @auth
                <li class="">
                    <form method="POST" action="{{ route('Logout') }}">
                        @csrf
                        <button type="submit">LogOut</button>
                    </form>
                </li>

                <li class=""><a href="{{ route('Users.index') }}">index</a></li>
                <li><a href="{{route('Users.edit', ['id' => auth()->id()])}}">Editar perfil</a></li>
                @endauth
                @guest
                <li class=""><a href="{{ route('Login') }}">Login</a></li>
                <li class=""><a href="{{ route('Register') }}">Register</a></li>
                @endguest
            </ul>
            <span class="btn_menu">
                <i class="fa fa-bars"></i>
            </span>
        </nav>

    </header>

    <div class="container-fluid container-vhs">
        <div class="row">
            <!-- Aside -->
            <aside class="col-md-3 aside-container">
                <h3>Menú Lateral</h3>
                <ul>
                    <li ><a class="btn-green" href="{{ route('Exercises.index') }}">Ejercicios</a></li>
                    <li ><a class="btn-green" href="{{route('Exercises.create')}}">Nuevo Ejercicio</a></li>
                    <li ><a class="btn-green" href="{{route('Trainings.index')}}">Entrenamientos</a></li>
                    <li ><a class="btn-green" href="{{route('Trainings.store')}}">Nuevo entrenamiento</a></li>
                        
                    <!-- Agrega más opciones según sea necesario -->
                </ul>
            </aside>

            <!-- Contenido principal -->
            <main class="col-md-9">
                @yield('content')
            </main>
        </div>
    </div>

    <footer class="bg-dark text-light sticky-footer py-4">
      <div class="row">
        <div class="col-md-4">
          <h5>Enlaces útiles</h5>
          <ul class="list-unstyled">
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Acerca de nosotros</a></li>
            <li><a href="#">Servicios</a></li>
            <li><a href="#">Contacto</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h5>Contacto</h5>
          <address>
            <strong>Nombre de la empresa</strong><br>
            Dirección de la empresa<br>
            Ciudad, País<br>
            Teléfono: 123-456-7890<br>
            Correo electrónico: info@empresa.com
          </address>
        </div>
        <div class="col-md-4">
          <h5>Redes Sociales</h5>
          <ul class="list-unstyled">
            <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
            <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
            <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
          </ul>
        </div>
      </div>
  </footer>
</body>
@if(isset($js))
@foreach ($js as $jsFile)
<script src="{{ asset('/resources/js/' . $jsFile) }}"></script>';
@endforeach
@endif
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>

</html>