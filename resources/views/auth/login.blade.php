@extends('layouts.base')

@section('head')
    <link rel="stylesheet" href="{{ asset('/assets/css/loginRegister.css') }}">

    <title>ShopXeng - Login - Register</title>
@endSection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container" id="container">
        <div class="formContainer sign-up">
            <form class="form" action="{{ route('register') }}" method="POST">
                @csrf
                <h2 class="form__title">Crea una cuenta</h2>
                
                <input class="form__input" name="name" type="text" placeholder="Nombre(s)">
                <input class="form__input" name="surname" type="text" placeholder="Apellidos">
                <input class="form__input" name="email" type="email" placeholder="Correo">
                <input class="form__input" name="password" type="password" placeholder="Contraseña">
                <input class="form__input" name="password_confirmation" type="password" placeholder="Confirmar Contraseña">
                <button class="form__btn" type="submit">Registrarte</button>
            </form>
        </div>
        <div class="formContainer sign-in">
            <form class="form" action="{{ route('login') }}" method="POST">
                @csrf
                <h2 class="form__title">Iniciar sesión</h2>
                
                <input class="form__input" name="email" type="email" placeholder="Correo">
                <input class="form__input" name="password" type="password" placeholder="Contraseña">
                <a class="form__forget" href="#">¿Olvidaste tu contraseña?</a>
                <button class="form__btn" type="submit">Entrar</button>
            </form>
        </div>
        <div class="toggleContainer">
            <div class="toggle">
                <div class="toggle__panel toggle__panel--left">
                    <h2 class="form__title">¡Bienvenido de vuelta!</h2>
                    <p class="toggle__msj">Ingrese sus datos personales para utilizar todas las funciones del sitio</p>
                    <button class="form__btn form__btn--hidden" id="login">Iniciar Sesión</button>
                </div>
                <div class="toggle__panel toggle__panel--right">
                    <h2 class="form__title">¡Hola!</h2>
                    <p class="toggle__msj">Regístrese con sus datos personales para utilizar todas las funciones del sitio</p>
                    <button class="form__btn form__btn--hidden" id="register">Registrarse</button>
                </div>
            </div>
        </div>
    </div>
@endSection

@section('scripts')
<script src="{{ asset('/assets/js/script.js') }}"></script>
@endSection