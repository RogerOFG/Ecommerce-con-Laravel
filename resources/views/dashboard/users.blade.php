@extends('layouts.dash')

@section('head')
    <title>Dashboard | ShopXeng</title>
@endSection

@section('opUser')
    class="active"
@endSection

@section('content')
    <main>
        <h1>Usuarios</h1>
        <!-- Analyses -->
        <div class="analyse analyse--three">

            <div class="element">
                <div class="status">
                    <i class='bx bx-user'></i>

                    <div class="info">
                        <h3>Registros</h3>
                        <h1>136</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class='bx bxs-user-badge'></i>

                    <div class="info">
                        <h3>Administradores</h3>
                        <h1>1</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class='bx bx-user-plus'></i>

                    <div class="info">
                        <h3>Nuevo</h3>
                        <h1>Admin</h1>
                    </div>
                </div>
            </div>

        </div>
        <!-- End of Analyses -->

        <!-- Recent Orders Table -->
        <div class="recent-orders">
            <h2>Usuarios Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Cedula</th>
                        <th>correo</th>
                        <th>Direcciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Roger Omar</td>
                        <td>Florez Garcia</td>
                        <td>1002212675</td>
                        <td>roger_flasx@hotmail.com</td>
                        <td>
                            <form action="{{ route('pageDashUA') }}">
                                <button type="submit" class="recent-orders-btn"><i class='bx bx-map'></i></button>
                            </form>
                        </td>
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
