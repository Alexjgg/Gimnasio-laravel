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


    <div class="container-fluid">
        @yield('content')
    </div>
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