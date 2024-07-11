@extends('layouts.base')
@extends('layouts.header')
@extends('layouts.footer')

@section('head')
    <link rel="stylesheet" href="{{ asset('/assets/css/address.css') }}">

    {{-- Kanit Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,500;0,600;0,700;0,800;0,900;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <title>ShopXeng - Añadir dirección</title>
@endSection

@section('content')
    <h2 class="main__ttl main__ttl--content">Modificar dirección</h2>

    <main class="main main--main">
        <div class="ubi">
            <a class="ubi__link" href="{{ route('pagePerfil') }}">Perfil</a>
            <div class="ubi__sep">></div>
            <a href="{{ route('pageInfo') }}" class="ubi__link">Información Personal</a>
            <div class="ubi__sep">></div>
            <a href="{{ route('pageAccountF') }}" class="ubi__link">Direcciones</a>
            <div class="ubi__sep">></div>
            <div class="ubi__link ubi__link--disabled">Modificar dirección</div>
        </div>

        <form action="{{ route('removeAddress', $address->id) }}" method="POST" class="delete">
            @csrf
            @method('DELETE')
            <button class="delete__btn">
                <span class="delete__span delete__txt">Delete</span>
                <span class="delete__span delete__icon">
                    <svg class="delete__svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path></svg>
                </span>
            </button>
        </form>

        <form class="inputs" action="{{ route('updateAddress', $address->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <input type="hidden" name="idUser" value="{{auth()->id()}}">

            <div class="inputs__wrapper">
                <div class="inputs__content inputs__content--two">
                    <input id="departamentos" class="inputs__text" name="department" type="text" autocomplete="false" value="{{ $address->department }}" required>
                    <div id="departContent" class="inputs__select inputs__select--hidde"></div>
                    <label class="inputs__lbl">Departamento</label>
                    <p class="inputs__error">Error: Debe elegir una de las opciones</p>
                </div>

                <div class="inputs__content inputs__content--two">
                    <input id="ciudades" class="inputs__text" name="city" type="text" autocomplete="false" value="{{ $address->city }}" required>
                    <div id="ciudContent" class="inputs__select inputs__select--hidde"></div>
                    <label class="inputs__lbl">Ciudad</label>
                    <p class="inputs__error">Error: Debe elegir una de las opciones</p>
                </div>
            </div>

            <div class="inputs__content">
                <input class="inputs__text" name="district" type="text" value="{{ $address->district }}" required>
                <label class="inputs__lbl">Barrio</label>
            </div>

            <div class="inputs__wrapper inputs__wrapper--address">
                <div class="inputs__content">
                    <select id="typeStreet" class="inputs__text inputs__text--width" autocomplete="off" onchange="newAddress()">
                        <option value="Avenida">Avenida</option>
                        <option value="Avenida Calle">Avenida Calle</option>
                        <option value="Avenida Carrera">Avenida Carrera</option>
                        <option value="Calle">Calle</option>
                        <option value="Carrera">Carrera</option>
                        <option value="Circular">Circular</option>
                        <option value="Circunvalar">Circunvalar</option>
                        <option value="Diagonal">Diagonal</option>
                        <option value="Manzana">Manzana</option>
                        <option value="Transversal">Transversal</option>
                        <option value="Vía">Vía</option>
                    </select>
                    <label class="inputs__lbl">Tipo de calle</label>
                </div>

                <div class="inputs__content">
                    <input id="streetNum" class="inputs__text inputs__text--width" type="text" oninput="newAddress()" required>
                    <label class="inputs__lbl">Calle / Carrera</label>
                </div>

                <div class="inputs__content inputs__content--symbol">
                    <p class="inputs__symbol">#</p>
                </div>

                <div class="inputs__content">
                    <input id="numFirst" class="inputs__text inputs__text--width" type="text" oninput="newAddress()" required>
                    <label class="inputs__lbl">Número</label>
                </div>

                <div class="inputs__content--symbol">
                    <p class="inputs__symbol">-</p>
                </div>

                <div class="inputs__content">
                    <input id="numSecond" class="inputs__text inputs__text--width" type="text" oninput="newAddress()" required>
                </div>
            </div>

            <div class="inputs__content">
                <input class="inputs__text" name="number" type="text" placeholder="Opcional" value="{{ $address->number }}">
                <label class="inputs__lbl">Piso/Departamento</label>
            </div>

            <div class="inputs__content">
                <input class="inputs__text inputs__text--phone" name="phone" type="text" value="{{ $address->phone }}" required>
                <label class="inputs__lbl">Telefono de contacto</label>
            </div>

            <div class="inputs__content">
                <textarea class="inputs__text inputs__text--textarea" name="info" required>{{ $address->info }}</textarea>
                <label class="inputs__lbl">Referencias adicionales de esta dirección</label>
            </div>

            <input id="addressInput" name="address" type="hidden" value="{{ $address->address }}">

            <div class="inputs__submit">
                <button type="submit" class="inputs__btn">Modificar</button>
            </div>

        </form>
    </main>
@endSection

@section('scripts')
    <script src="{{ asset('/assets/js/address.js') }}"></script>
    <script src="{{ asset('/assets/js/colombia.js') }}"></script>
    <script>
        setAddressValues();

        document.addEventListener('DOMContentLoaded', () => {
            const input = document.querySelector('.inputs__text--phone');

            input.addEventListener('input', () => {
                input.value = input.value.replace(/\D/g, '');
            });
        });
    </script>
@endSection