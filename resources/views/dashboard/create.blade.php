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
                    <select class="form__input form__select" name="category" required>
                        <option disabled selected></option>
                        <option value="Relojeria">Relojeria</option>
                        <option value="Otros">Otros</option>
                    </select>
                    <span class="form__name">Categoria</span>
                </div>

                <div class="form__content">
                    <select class="form__input form__select" name="brand" required>
                        <option disabled selected></option>
                        <option value="Q&Q">Q&Q</option>
                        <option value="Rolex">Rolex</option>
                        <option value="Cassio">Cassio</option>
                    </select>
                    <span class="form__name">Marca</span>
                </div>

                <div class="form__content">
                    <input class="form__input form__select" name="price" type="number" required>
                    <span class="form__name">Precio xu</span>
                </div>

                <div class="form__content">
                    <input class="form__input form__select" name="cristal" type="text" required>
                    <span class="form__name">Material del cristal</span>
                </div>

                <div class="form__content">
                    <input class="form__input form__select" name="caja" type="text" required>
                    <span class="form__name">Material de la caja</span>
                </div>

                <div class="form__content">
                    <input class="form__input form__select" name="pulsera" type="text" required>
                    <span class="form__name">Material de la pulsera</span>
                </div>
                
                <div class="form__content">
                    <select class="form__input form__select" name="manecillas" required>
                        <option disabled selected></option>
                        <option value="Hora, minutos y segundos">Hora, minutos y segundos</option>
                        <option value="Hora y minutos">Hora y minutos</option>
                    </select>
                    <span class="form__name">Manecillas</span>
                </div>

                <div class="form__content">
                    <input class="form__input form__select" name="metrosAgua" type="text" required>
                    <span class="form__name">Resistente al agua (metros)</span>
                </div>

                <div class="form__content--area">
                    <div class="form__content">
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
@endSection