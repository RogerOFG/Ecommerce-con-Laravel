<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="title" content="ShopXeng - Relojes AAA de Alta Calidad en Colombia | Envíos GRATIS y Pago Contra Entrega">
    <meta name="description" content="Bienvenido a ShopXeng - Relojes AAA en Colombia. Ofrecemos Envíos GRATIS y Pago Contra Entrega. ¡Compra los mejores relojes ahora!">
    <meta property="og:title" content="ShopXeng - Relojes AAA de Alta Calidad en Colombia | Envíos GRATIS y Pago Contra Entrega">
    <meta property="og:description" content="Bienvenido a ShopXeng - Relojes AAA en Colombia. Ofrecemos Envíos GRATIS y Pago Contra Entrega. ¡Compra los mejores relojes ahora!">

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
                <div class="alert__close alert__close--success"> 
                    <i class="bi bi-check2-circle"></i>
                </div>

                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-controller alert-error">
                <div class="alert__close"> 
                    <i class="bi bi-exclamation-circle"></i>
                </div>

                {{ session('error') }}
            </div>
        @elseif (session('warning'))
            <div class="alert alert-controller alert-warning">
                <div class="alert__close alert__close--warning"> 
                    <i class="bi bi-exclamation-circle"></i>
                </div>

                {{ session('warning') }}
            </div>
        @endif

        <!-- Validacion de errores -->
        @if ($errors->any())
            <div class="alert alert-controller alert-error">
                <div class="alert__close"> 
                    <i class="bi bi-exclamation-circle"></i>
                </div>

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
                <a href="{{ route('comprarCart') }}" title="Compra directa">
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