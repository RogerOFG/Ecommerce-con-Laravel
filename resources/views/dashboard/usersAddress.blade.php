@extends('layouts.dash')

@section('head')
    <title>Dashboard | ShopXeng</title>
@endSection

@section('opUser')
    class="active"
@endSection

@section('content')
    <main>
        <h1>Direcciones</h1>

        <!-- Recent Orders Table -->
        <div class="recent-orders">
            <h2>Usuarios Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Ciudad</th>
                        <th>Departamento</th>
                        <th>Barrio</th>
                        <th>Dirección</th>
                        <th>Info</th>
                        <th>Numero Casa</th>
                        <th>Celular</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Roger Omar Florez Garcia</td>
                        <td>Barranquilla</td>
                        <td>Atlantico</td>
                        <td>San Isidro</td>
                        <td>Calle 50 No 23 - 42</td>
                        <td>Es una casa</td>
                        <td>Aprt 101</td>
                        <td>3005369591</td>
                    </tr>
                </tbody>
            </table>
            <a href="#">Show All</a>
        </div>
        <!-- End of Recent Orders -->

    </main>
@endSection

@section('scripts')
@endSection
