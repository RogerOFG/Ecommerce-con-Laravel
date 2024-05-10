@extends('layouts.dash')

@section('head')
    <title>Dashboard | ShopXeng</title>
@endSection

@section('opUser')
    class="active"
@endSection

@section('content')
    <main>
        <h1>Usuario</h1>
        <!-- Analyses -->
        <div class="analyse analyse--three">

            <div class="element">
                <div class="status">
                    <i class='bx bx-user'></i>

                    <div class="info">
                        <h2>Nombre</h2>
                        <h3>Roger Omar Florez Garcia</h3>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class='bx bx-envelope'></i>

                    <div class="info">
                        <h2>Correo</h3>
                        <h3>roger_flasx@hotmail.com</h3>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class='bx bx-id-card'></i>

                    <div class="info">
                        <h2>Cedula</h3>
                        <h3>1002212675</h3>
                    </div>
                </div>
            </div>

        </div>
        <!-- End of Analyses -->

        <!-- Recent Orders Table -->
        <div class="recent-orders">
            <h2>Direccion(es) del usuario</h2>
            <table>
                <thead>
                    <tr>
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
        </div>
        <!-- End of Recent Orders -->

    </main>
@endSection

@section('scripts')
@endSection
