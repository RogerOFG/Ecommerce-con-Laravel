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
                    <select class="form__input form__select" name="category" required>
                        <option disabled></option>
                        <option value="Relojeria" {{ $prod->category == 'Relojeria' ? 'selected' : ''}}>Relojeria</option>
                        <option value="Otros" {{ $prod->category == 'Otros' ? 'selected' : ''}}>Otros</option>
                    </select>
                    <span class="form__name">Categoria</span>
                </div>

                <div class="form__content">
                    <select class="form__input form__select" name="brand" required>
                        <option disabled></option>
                        <option value="Q&Q" {{ $prod->brand == 'Q&Q' ? 'selected' : '' }}>Q&Q</option>
                        <option value="Rolex" {{ $prod->brand == 'Rolex' ? 'selected' : '' }}>Rolex</option>
                        <option value="Orient" {{ $prod->brand == 'Orient' ? 'selected' : '' }}>Orient</option>
                        <option value="Tissot" {{ $prod->brand == 'Tissot' ? 'selected' : '' }}>Tissot</option>
                    </select>
                    <span class="form__name">Marca</span>
                </div>

                <div class="form__content">
                    <input class="form__input form__select" name="price" type="number" value="{{ $prod->price }}" required>
                    <span class="form__name">Precio xu</span>
                </div>

                <div class="form__content">
                    <input class="form__input form__select" name="cristal" type="text" value="{{ $prod->cristal }}" required>
                    <span class="form__name">Material del cristal</span>
                </div>

                <div class="form__content">
                    <input class="form__input form__select" name="caja" type="text" value="{{ $prod->caja }}" required>
                    <span class="form__name">Material de la caja</span>
                </div>

                <div class="form__content">
                    <input class="form__input form__select" name="pulsera" type="text" value="{{ $prod->pulsera }}" required>
                    <span class="form__name">Material de la pulsera</span>
                </div>
                
                <div class="form__content">
                    <select class="form__input form__select" name="manecillas" value="{{ $prod->manecillas }}" required>
                        <option disabled selected></option>
                        <option value="Hora, minutos y segundos" {{ $prod->manecillas == 'Hora, minutos y segundos' ? 'selected' : '' }}>Hora, minutos y segundos</option>
                        <option value="Hora y minutos" {{ $prod->manecillas == 'Hora y minutos' ? 'selected' : '' }}>Hora y minutos</option>
                    </select>
                    <span class="form__name">Manecillas</span>
                </div>

                <div class="form__content">
                    <input class="form__input form__select" name="metrosAgua" type="text" value="{{ $prod->metrosAgua }}" required>
                    <span class="form__name">Resistente al agua (metros)</span>
                </div>

                <div class="form__content--area">
                    <div class="form__content">
                        <input class="form__input form__select" name="garanty" type="text" value="{{ $prod->garanty }}" required>
                        <span class="form__name">Garantia</span>
                    </div>

                    <div class="form__content">
                        <input class="form__input form__select" name="amountAvailable" type="number" value="{{ $prod->amountAvailable }}" required>
                        <span class="form__name">Cantidad</span>
                    </div>
                </div>

                <div class="form__content">
                    <button class="form__btn" type="submit">Modificar</button>
                </div>
            </form>
        </div>

    </main>
@endSection

@section('scripts')
@endSection