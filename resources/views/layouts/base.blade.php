<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{ asset('/assets/img/logo/icon/icon-black.ico') }}">

    <link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/headerFooter.css') }}">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    @yield('head')
</head>
<body>
    <div class="wrapper">
        <!-- Recibir Alertas -->
        @if(session('success'))
            <div class="alert alert-controller alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-controller alert-error">
                {{ session('error') }}
            </div>
        @elseif (session('warning'))
            <div class="alert alert-controller alert-warning">
                {{ session('warning') }}
            </div>
        @endif

        <!-- Validacion de errores -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="loader">
            <div class="spinner">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>

        @yield('header')

        @yield('content')

        @yield('footer')

        @if (Auth::check())
            @if ($totalAmount)
                <a href="{{ route('comprarCart') }}">
                    <button class="btnShop">
                        ¡Comprar ahora!
                        <span class="btnShop__icon">
                            <i class="btnShop__i bi bi-bag"></i>
                        </span>
                    </button>
                </a>
            @endif
        @endif

    </div>

    @yield('scripts')
    <script src="{{ asset('/assets/js/header.js') }}"></script>
</body>
</html>