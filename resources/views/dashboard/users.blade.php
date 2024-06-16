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
        <div class="analyse">

            <div class="element">
                <div class="status">
                    <i class="bi bi-person"></i>

                    <div class="info">
                        <h3>Usuarios</h3>
                        <h1>{{ $totalUsers }}</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class="bi bi-calendar-event"></i>

                    <div class="info">
                        <h3>Registros del día</h3>
                        <h1>{{ $totalUsersDay }}</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class="bi bi-person-badge-fill"></i>

                    <div class="info">
                        <h3>Administradores</h3>
                        <h1>{{ $totalAdmins }}</h1>
                    </div>
                </div>
            </div>

            <a href="{{ route('registerAdmin') }}" class="element element--hover">
                <div class="status">
                    <i class="bi bi-person-plus"></i>

                    <div class="info">
                        <h3>Nuevo</h3>
                        <h1>Admin</h1>
                    </div>
                </div>
            </a>

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
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->surname }}</td>
                            <td>{{ $user->numCC }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('pageDashUA', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="recent-orders-btn"><i class="bi bi-geo-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- End of Recent Orders -->

        {{ $users->links('layouts.pagination') }}

    </main>
@endSection

@section('scripts')
@endSection
