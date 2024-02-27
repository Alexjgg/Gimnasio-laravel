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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
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
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">LogOut</button>
                    </form>
                </li>
                <li><a href="{{route('usuarios.editar',['id' => auth()->id()])}}">Editar perfil</a></li>
                @endauth
                @guest
                <li class=""><a href="{{ route('login') }}">Login</a></li>
                <li class=""><a href="{{ route('login') }}">Register</a></li>
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

    <script src="assets/js/navsuperior.js"></script>
    <script src="assets/js/navlateral.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 4 -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <?php
    if (isset($js) && is_array($js)) {
        foreach ($js as $jsFile) {
            echo '<script src="' . $jsFile . '"></script>';
        }
    }
    ?>
</body>


</html>