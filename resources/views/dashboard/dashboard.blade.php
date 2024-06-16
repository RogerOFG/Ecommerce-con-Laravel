@extends('layouts.dash')

@section('head')
    <title>Dashboard | ShopXeng</title>
@endSection

@section('opDash')
    class="active"
@endSection

@section('content')
    <main>
        <h1>Dashboard</h1>
        <!-- Analyses -->
        <div class="analyse analyse--three">

            <div class="element">
                <div class="status">
                    <i class="bi bi-calendar-check"></i>

                    <div class="info">
                        <h3>Ventas totales</h3>
                        <h1>${{ number_format($totalSales, 0, '.', '.') }}</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class="bi bi-watch"></i>

                    <div class="info">
                        <h3>Productos vendidos</h3>
                        <h1>{{ $totalProSales }}</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class="bi bi-person-add"></i>

                    <div class="info">
                        <h3>Registros</h3>
                        <h1>{{ $totalUsers }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Analyses -->

        <!-- Recent Orders Table -->
        <div class="recent-orders">
            <h2>Pedidos del dia</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Roger Omar Florez Garcia</td>
                        <td>Q&Q Hombre</td>
                        <td>1</td>
                        <td>En camino</td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('pageDashO') }}">Show All</a>
        </div>
        <!-- End of Recent Orders -->

    </main>
@endSection

@section('scripts')
@endSection
