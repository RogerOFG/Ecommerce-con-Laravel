@extends('layouts.base')

@section('head')
    <link rel="stylesheet" href="{{ asset('/assets/css/loginRegister.css') }}">

    <title>ShopXeng - Login - Register</title>
@endSection

@section('content')
    <div class="container" id="container">
        <div class="formContainer sign-up">
            <form id="formularioRegister" class="form" action="{{ route('register') }}" method="POST">
                @csrf
                <h2 class="form__title">Crea una cuenta</h2>

                {{-- Nombre --}}
                <div id="grupo__name" class="form__content-wrapper">
                    <div class="form__content-input">
                        <input class="form__input" name="name" type="text" placeholder="Nombre(s)">
                    </div>
                    <span class="form__error">No se admiten numeros ni simbolos</span>
                </div>

                {{-- Apellidos --}}
                <div id="grupo__surname" class="form__content-wrapper">
                    <div class="form__content-input">
                        <input class="form__input" name="surname" type="text" placeholder="Apellidos">
                    </div>
                    <span class="form__error">No se admiten numeros ni simbolos</span>
                </div>

                {{-- Correo --}}
                <div id="grupo__email" class="form__content-wrapper">
                    <div class="form__content-input">
                        <input class="form__input" name="email" type="email" placeholder="Correo">
                    </div>
                    <span class="form__error">Formato de correo erroneo</span>
                </div>

                {{-- Password --}}
                <div id="grupo__password" class="form__content-wrapper">
                    <div class="form__content-input">
                        <input id="password" class="form__input" name="password" type="password" placeholder="Contraseña">
                        <i id="showPass" class="form__icon-eye bi bi-eye active" onclick="showPass('password', 'showPass', 'hiddePass')"></i>
                        <i id="hiddePass" class="form__icon-eye bi bi-eye-slash" onclick="showPass('password', 'showPass', 'hiddePass')"></i>
                    </div>
                    <span class="form__error">La contraseña debe tener minimo 8 digitos</span>
                </div>

                {{-- Password Verificación --}}
                <div id="grupo__password2" class="form__content-wrapper">
                    <div class="form__content-input">
                        <input id="password2" class="form__input" name="password_confirmation" type="password" placeholder="Confirmar Contraseña">
                        <i id="showPassV" class="form__icon-eye bi bi-eye active" onclick="showPass('password2', 'showPassV', 'hiddePassV')"></i>
                        <i id="hiddePassV" class="form__icon-eye bi bi-eye-slash" onclick="showPass('password2', 'showPassV', 'hiddePassV')"></i>
                    </div>
                    <span class="form__error">Las   contraseñas no coinciden</span>
                </div>

                <button class="form__btn" type="submit">Registrarte</button>
            </form>
        </div>
        <div class="formContainer sign-in">
            <form class="form" action="{{ route('login') }}" method="POST">
                @csrf
                <h2 class="form__title">Iniciar sesión</h2>
                
                <div class="form__content-wrapper">
                    <input class="form__input" name="email" type="email" placeholder="Correo">
                </div>
                <div class="form__content-wrapper">
                    <div class="form__content-input">
                        <input id="passLogin" class="form__input" name="password" type="password" placeholder="Contraseña">
                        <i id="showPassL" class="form__icon-eye bi bi-eye active" onclick="showPass('passLogin', 'showPassL', 'hiddePassL')"></i>
                        <i id="hiddePassL" class="form__icon-eye bi bi-eye-slash" onclick="showPass('passLogin', 'showPassL', 'hiddePassL')"></i>
                    </div>
                </div>
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