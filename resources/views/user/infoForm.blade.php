@extends('layouts.base')
@extends('layouts.header')
@extends('layouts.footer')

@section('head')
<link rel="stylesheet" href="{{ asset('/assets/css/address.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/perfil.css') }}">

    <title>ShopXeng - Perfil</title>
@endSection

@section('content')
    <main class="section">
        <h2 class="main__ttl">Administra tu información</h2>

        <div class="main__bot">
            <div class="ubi">
                <a class="ubi__link" href="{{ route('pagePerfil') }}">Perfil</a>
                <div class="ubi__sep">></div>
                <a href="{{ route('pageInfo') }}" class="ubi__link">Información Personal</a>
                <div class="ubi__sep">></div>
                <div class="ubi__link ubi__link--disabled">Datos  personales</div>
            </div>

            <div class="content">
<<<<<<< HEAD
                @foreach ($user as $user)
=======
>>>>>>> fb40287 (a)
                <form class="form" action="{{ route('saveInfo') }}" method="POST">
                    @csrf

                    <div class="inputs__wrapper">
                        <div class="inputs__content inputs__content--two">
<<<<<<< HEAD
                            <input class="inputs__text" name="name" type="text" value="{{ $user->name }}" required>
=======
                            <input class="inputs__text" name="name" type="text" required>
>>>>>>> fb40287 (a)
                            <label class="inputs__lbl">Nombre(s)</label>
                        </div>

                        <div class="inputs__content inputs__content--two">
<<<<<<< HEAD
                            <input class="inputs__text" name="surname" type="text" value="{{ $user->surname }}" required>
=======
                            <input class="inputs__text" name="surname" type="text" required>
>>>>>>> fb40287 (a)
                            <label class="inputs__lbl">Apellidos</label>
                        </div>
                    </div>

                    <div class="inputs__content">
<<<<<<< HEAD
                        <input class="inputs__text" name="numCC" type="text" value="{{ $user->numCC }}" required>
=======
                        <input class="inputs__text" name="numCC" type="text" required>
>>>>>>> fb40287 (a)
                        <label class="inputs__lbl">Documento de identidad</label>
                    </div>

                    <div class="inputs__submit">
                        <button type="submit" class="inputs__btn">Guardar</button>
                    </div>

                </form>
<<<<<<< HEAD
                @endforeach
=======
>>>>>>> fb40287 (a)
            </div>
        </div>
    </main>
@endSection

@section('scripts')

@endSection
