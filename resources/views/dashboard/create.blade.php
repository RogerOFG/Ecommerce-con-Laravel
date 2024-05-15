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

        <!-- Recent Orders Table -->
        <div class="recent-orders recent--form">
            <form class="form form--gap" action="{{route('pageSaveP')}}" method="POST">
                @csrf

                <div class="form__content">
                    <input class="form__input" name="name" type="text" required>
                    <span class="form__name">Nombre</span>
                </div>

                <div class="form__content">
                    <span class="form__name">Categoria</span>
                    <select class="form__input" name="category" required>
                        <option disabled selected></option>
                        <option value="Relojeria">Relojeria</option>
                        <option value="Otros">Otros</option>
                    </select>
                </div>

                <div class="form__content">
                    <span class="form__name">Marca</span>
                    <select class="form__input" name="brand" required>
                        <option disabled selected></option>
                        <option value="Q&Q">Q&Q</option>
                        <option value="Rolex">Rolex</option>
                        <option value="Cassio">Cassio</option>
                    </select>
                </div>

                <div class="form__content">
                    <input class="form__input" name="price" type="number" required>
                    <span class="form__name">Precio xu</span>
                </div>

                <div class="form__content">
                    <input class="form__input" name="cristal" type="text" required>
                    <span class="form__name">Material del cristal</span>
                </div>

                <div class="form__content">
                    <input class="form__input" name="caja" type="text" required>
                    <span class="form__name">Material de la caja</span>
                </div>

                <div class="form__content">
                    <input class="form__input" name="pulsera" type="text" required>
                    <span class="form__name">Material de la pulsera</span>
                </div>
                
                <div class="form__content">
                    <span class="form__name">Manecillas</span>
                    <select class="form__input" name="manecillas" required>
                        <option disabled selected></option>
                        <option value="Hora, minutos y segundos">Hora, minutos y segundos</option>
                        <option value="Hora y minutos">Hora y minutos</option>
                    </select>
                </div>

                <div class="form__content">
                    <input class="form__input" name="metrosAgua" type="text" required>
                    <span class="form__name">Resistente al agua (metros)</span>
                </div>

                <div class="form__content--area">
                    <div class="form__content">
                        <input class="form__input" name="garanty" type="text" required>
                        <span class="form__name">Garantia</span>
                    </div>

                    <div class="form__content">
                        <input class="form__input" name="amountAvailable" type="number" required>
                        <span class="form__name">Cantidad</span>
                    </div>
                </div>

                <div class="form__content">
                    <button class="form__btn" type="submit">Registrar</button>
                </div>
            </form>
        </div>
        <!-- End of Recent Orders -->

    </main>
@endSection

@section('scripts')
@endSection