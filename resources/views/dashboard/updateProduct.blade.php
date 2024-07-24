@extends('layouts.dash')

@section('head')
    <title>Dashboard | Modificar Producto</title>
@endSection

@section('opProd')
    class="active"
@endSection

@section('content')
    <main>
        <h1>Modificar Producto</h1>

        <div class="recent--form">
            <form class="form form--gap" action="{{route('pageUpdateS', $prod->id)}}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form__content">
                    <input class="form__input form__select" name="name" type="text" value="{{ $prod->name }}" required>
                    <span class="form__name">Nombre</span>
                </div>

                <div class="form__content">
                    <select id="categoryProduct" class="form__input form__select" name="category" onchange="changeForm()" required>
                        <option disabled></option>
                        <option value="Relojeria" {{ $prod->category == 'Relojeria' ? 'selected' : ''}}>Relojeria</option>
                        <option value="Bisuteria" {{ $prod->category == 'Bisuteria' ? 'selected' : ''}}>Bisuteria</option>
                    </select>
                    <span class="form__name">Categoria</span>
                </div>

                {{-- BISUTERIA --}}
                <div class="form__content bisuteriaForm hidde">
                    <select class="form__input form__select" name="bisuteria_hilo">
                        <option value="Hilo Chino" {{ $prod->bisuteria_hilo == 'Hilo Chino' ? 'selected' : ''}}>Hilo chino</option>
                        <option value="Hilo Terlenka" {{ $prod->bisuteria_hilo == 'Hilo Terlenka' ? 'selected' : ''}}>Hilo terlenka</option>
                        <option value="Hilo colita de rata" {{ $prod->bisuteria_hilo == 'Hilo colita de rata' ? 'selected' : ''}}>Hilo colita de rata</option>
                        <option value="Nilo" {{ $prod->bisuteria_hilo == 'Nilo' ? 'selected' : ''}}>Nilo</option>
                    </select>
                    <span class="form__name">Material hilo</span>
                </div>

                {{-- BISUTERIA --}}
                <div class="form__content bisuteriaForm hidde">
                    <select class="form__input form__select" name="bisuteria_piedras">
                        <option disabled selected></option>
                        <option value="Chaquira checas" {{ $prod->bisuteria_piedras == 'Chaquira checas' ? 'selected' : ''}}>Chaquira checas</option>
                        <option value="Murano" {{ $prod->bisuteria_piedras == 'Murano' ? 'selected' : ''}}>Murano</option>
                        <option value="Perlas" {{ $prod->bisuteria_piedras == 'Perlas' ? 'selected' : ''}}>Perlas</option>
                        <option value="Neo preno" {{ $prod->bisuteria_piedras == 'Neo preno' ? 'selected' : ''}}>Neo preno</option>
                    </select>
                    <span class="form__name">Material piedritas</span>
                </div>

                {{-- BISUTERIA --}}
                <div class="form__content bisuteriaForm hidde">
                    <select class="form__input form__select" name="bisuteria_dijen">
                        <option disabled selected></option>
                        <option value="Acero inoxidable" {{ $prod->bisuteria_dijen == 'Acero inoxidable' ? 'selected' : ''}}>Acero inoxidable</option>
                        <option value="" {{ $prod->bisuteria_dijen == '' ? 'selected' : ''}}>NO APLICA</option>
                    </select>
                    <span class="form__name">Material del dijen</span>
                </div>

                {{-- BISUTERIA --}}
                <div class="form__content bisuteriaForm hidde">
                    <select class="form__input form__select" name="bisuteria_cierre">
                        <option disabled selected></option>
                        <option value="Nudo corredizo para ajuste" {{ $prod->bisuteria_cierre == 'Nudo corredizo para ajuste' ? 'selected' : ''}}>Nudo corredizo</option>
                        <option value="Broche" {{ $prod->bisuteria_cierre == 'Broche' ? 'selected' : ''}}>Broche</option>
                    </select>
                    <span class="form__name">Tipo de Cierre</span>
                </div>

                {{-- RELOJERIA --}}
                <div class="form__content relojeriaForm">
                    <select class="form__input form__select" name="brand" required>
                        <option disabled selected></option>
                        <option value="Q&Q" {{ $prod->brand == 'Q&Q' ? 'selected' : ''}}>Q&Q</option>
                        <option value="Rolex" {{ $prod->brand == 'Rolex' ? 'selected' : ''}}>Rolex</option>
                        <option value="Orient" {{ $prod->brand == 'Orient' ? 'selected' : ''}}>Orient</option>
                        <option value="Tissot" {{ $prod->brand == 'Tissot' ? 'selected' : ''}}>Tissot</option>
                        <option value="Casio" {{ $prod->brand == 'Casio' ? 'selected' : ''}}>Casio</option>
                        <option value="Hublot" {{ $prod->brand == 'Hublot' ? 'selected' : ''}}>Hublot</option>
                        <option value="Cartier" {{ $prod->brand == 'Cartier' ? 'selected' : ''}}>Cartier</option>
                        <option value="Invicta" {{ $prod->brand == 'Invicta' ? 'selected' : ''}}>Invicta</option>
                        <option value="Technomarine" {{ $prod->brand == 'Technomarine' ? 'selected' : ''}}>Technomarine</option>
                        <option value="Tommy" {{ $prod->brand == 'Tommy' ? 'selected' : ''}}>Tommy</option>
                    </select>
                    <span class="form__name">Marca</span>
                </div>

                <div class="form__content">
                    <input class="form__input form__select" name="price" type="number" value="{{ $prod->price }}" required>
                    <span class="form__name">Precio xu</span>
                </div>

                {{-- RELOJERIA --}}
                <div class="form__content relojeriaForm">
                    <input class="form__input form__select" name="cristal" type="text" value="{{ $prod->cristal }}" required>
                    <span class="form__name">Material del cristal</span>
                </div>

                {{-- RELOJERIA --}}
                <div class="form__content relojeriaForm">
                    <input class="form__input form__select" name="caja" type="text" value="{{ $prod->caja }}" required>
                    <span class="form__name">Material de la caja</span>
                </div>

                {{-- RELOJERIA --}}
                <div class="form__content relojeriaForm">
                    <input class="form__input form__select" name="pulsera" type="text" value="{{ $prod->pulsera }}" required>
                    <span class="form__name">Material de la pulsera</span>
                </div>

                {{-- RELOJERIA --}}
                <div class="form__content relojeriaForm">
                    <select class="form__input form__select" name="manecillas" required>
                        <option disabled selected></option>
                        <option value="Hora, minutos y segundos" {{ $prod->manecillas == 'Hora, minutos y segundos' ? 'selected' : ''}}>Hora, minutos y segundos</option>
                        <option value="Hora y minutos" {{ $prod->manecillas == 'Hora y minutos' ? 'selected' : ''}}>Hora y minutos</option>
                        <option value="1" {{ $prod->manecillas == '1' ? 'selected' : ''}}>Digital</option>
                        <option value="2" {{ $prod->manecillas == '2' ? 'selected' : ''}}>Analogo y Digital (2 manecillas)</option>
                        <option value="3" {{ $prod->manecillas == '3' ? 'selected' : ''}}>Analogo y Digital (3 manecillas)</option>
                    </select>
                    <span class="form__name">Manecillas</span>
                </div>

                {{-- RELOJERIA --}}
                <div class="form__content relojeriaForm">
                    <input class="form__input form__select" name="metrosAgua" type="text" value="{{ $prod->metrosAgua }}" required>
                    <span class="form__name">Resistente al agua (metros)</span>
                </div>

                <div class="form__content form__content--area">
                    {{-- RELOJERIA --}}
                    <div class="form__content relojeriaForm">
                        <input class="form__input form__select" name="garanty" type="text" value="{{ $prod->garanty }}" required>
                        <span class="form__name">Garantia</span>
                    </div>

                    <div class="form__content">
                        <input class="form__input form__select" name="amountAvailable" type="number" value="{{ $prod->amountAvailable }}" required>
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