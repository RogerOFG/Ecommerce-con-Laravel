@extends('layouts.dash')

@section('head')
    <title>Dashboard | Nuevo Admin</title>
@endSection

@section('opUser')
    class="active"
@endSection

@section('content')
    <main>
        <h1>Registro de Administrador</h1>

        <!-- Recent Orders Table -->
        <div class="recent--form">
            <form class="form" action="{{ route('saveAdmin') }}" method="POST">
                @csrf

                <div class="form__content">
                    <input class="form__input" name="name" type="text" placeholder="Nombre(s)" required>
                    <i class="bi bi-person-fill"></i>
                    <span class="form__line">|</span>
                </div>

                <div class="form__content">
                    <input class="form__input" name="surname" type="text" placeholder="Apellidos" required>
                    <i class="bi bi-person-fill"></i>
                    <span class="form__line">|</span>
                </div>

                <div class="form__content">
                    <input class="form__input" name="email" type="email" placeholder="Correo" required>
                    <i class="bi bi-envelope-fill"></i>
                    <span class="form__line">|</span>
                </div>

                <div class="form__content">
                    <input class="form__input" name="password" type="password" placeholder="Contraseña" required>
                    <i class="bi bi-key-fill"></i>
                    <span class="form__line">|</span>
                </div>

                <div class="form__content">
                    <input class="form__input" name="admin" type="hidden" value="1">
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
