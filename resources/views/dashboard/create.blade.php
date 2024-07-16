@extends('layouts.dash')

@section('head')
    <title>Dashboard | Nuevo Producto</title>
@endSection

@section('opProd')
    class="active"
@endSection

@section('content')
    <main>
        <h1>Registro de Productos</h1>

        <div class="recent--form">
            <form class="form form--gap" action="{{route('pageSaveP')}}" method="POST">
                @csrf

                <div class="form__content">
                    <input class="form__input form__select" name="name" type="text" required>
                    <span class="form__name">Nombre</span>
                </div>

                <div class="form__content">
                    <select id="categoryProduct" class="form__input form__select" name="category" onchange="changeForm()" required>
                        <option selected value="Relojeria">Relojeria</option>
                        <option value="Bisuteria">Bisuteria</option>
                    </select>
                    <span class="form__name">Categoria</span>
                </div>

                {{-- BISUTERIA --}}
                <div class="form__content bisuteriaForm hidde">
                    <select class="form__input form__select" name="bisuteria_hilo">
                        <option disabled selected></option>
                        <option value="Hilo Chino">Hilo chino</option>
                        <option value="Hilo Terlenka">Hilo terlenka</option>
                        <option value="Hilo colita de rata">Hilo colita de rata</option>
                        <option value="Nilo">Nilo</option>
                    </select>
                    <span class="form__name">Material hilo</span>
                </div>

                {{-- BISUTERIA --}}
                <div class="form__content bisuteriaForm hidde">
                    <select class="form__input form__select" name="bisuteria_piedras">
                        <option disabled selected></option>
                        <option value="Chaquira checas">Chaquira checas</option>
                        <option value="Murano">Murano</option>
                        <option value="Perlas">Perlas</option>
                        <option value="Neo preno">Neo preno</option>
                    </select>
                    <span class="form__name">Material piedritas</span>
                </div>

                {{-- BISUTERIA --}}
                <div class="form__content bisuteriaForm hidde">
                    <select class="form__input form__select" name="bisuteria_dijen">
                        <option disabled selected></option>
                        <option value="Acero inoxidable">Acero inoxidable</option>
                        <option value="">NO APLICA</option>
                    </select>
                    <span class="form__name">Material del dijen</span>
                </div>

                {{-- BISUTERIA --}}
                <div class="form__content bisuteriaForm hidde">
                    <select class="form__input form__select" name="bisuteria_cierre">
                        <option disabled selected></option>
                        <option value="Nudo corredizo para ajuste">Nudo corredizo</option>
                        <option value="Broche">Broche</option>
                    </select>
                    <span class="form__name">Tipo de Cierre</span>
                </div>

                {{-- RELOJERIA --}}
                <div class="form__content relojeriaForm">
                    <select class="form__input form__select" name="brand" required>
                        <option disabled selected></option>
                        <option value="Q&Q">Q&Q</option>
                        <option value="Rolex">Rolex</option>
                        <option value="Orient">Orient</option>
                        <option value="Tissot">Tissot</option>
                    </select>
                    <span class="form__name">Marca</span>
                </div>

                <div class="form__content">
                    <input class="form__input form__select" name="price" type="number" required>
                    <span class="form__name">Precio xu</span>
                </div>

                {{-- RELOJERIA --}}
                <div class="form__content relojeriaForm">
                    <input class="form__input form__select" name="cristal" type="text" required>
                    <span class="form__name">Material del cristal</span>
                </div>

                {{-- RELOJERIA --}}
                <div class="form__content relojeriaForm">
                    <input class="form__input form__select" name="caja" type="text" required>
                    <span class="form__name">Material de la caja</span>
                </div>

                {{-- RELOJERIA --}}
                <div class="form__content relojeriaForm">
                    <input class="form__input form__select" name="pulsera" type="text" required>
                    <span class="form__name">Material de la pulsera</span>
                </div>

                {{-- RELOJERIA --}}
                <div class="form__content relojeriaForm">
                    <select class="form__input form__select" name="manecillas" required>
                        <option disabled selected></option>
                        <option value="Hora, minutos y segundos">Hora, minutos y segundos</option>
                        <option value="Hora y minutos">Hora y minutos</option>
                    </select>
                    <span class="form__name">Manecillas</span>
                </div>

                {{-- RELOJERIA --}}
                <div class="form__content relojeriaForm">
                    <input class="form__input form__select" name="metrosAgua" type="text" required>
                    <span class="form__name">Resistente al agua (metros)</span>
                </div>

                <div class="form__content form__content--area">
                    {{-- RELOJERIA --}}
                    <div class="form__content relojeriaForm">
                        <input class="form__input form__select" name="garanty" type="text" required>
                        <span class="form__name">Garantia</span>
                    </div>

                    <div class="form__content">
                        <input class="form__input form__select" name="amountAvailable" type="number" required>
                        <span class="form__name">Cantidad</span>
                    </div>
                </div>

                <div class="form__content">
                    <button class="form__btn" type="submit">Registrar</button>
                </div>
            </form>
        </div>

    </main>
@endSection

@section('scripts')
    <script src="{{ asset('/assets/js/formProduct.js') }}"></script>
@endSection