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
                        <th>Precio x unidad</th>
                        <th>Total pago</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordersToday as $item)
                    <tr>
                        <td>{{ $item->user->name }} {{ $item->user->surname }}</td>
                        <td>{{ $item->prod->name }}</td>
                        <td>{{ $item->amount }}</td>
                        <td>{{ number_format($item->prod->price, 0, '.', '.') }}</td>
                        <td>{{ number_format($item->total, 0, '.', '.') }}</td>
                        @if ($item->state == 0)
                            <td class="cancel">Cancelado</td>
                        @elseif ($item->state == 1)
                            <td class="process">En proceso</td>
                        @elseif ($item->state == 2)
                            <td class="way">En camino</td>
                        @elseif ($item->state == 3)
                            <td class="delivered">Entregado</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('pageDashO') }}">Show All</a>
        </div>
        <!-- End of Recent Orders -->

    </main>
@endSection

@section('scripts')
@endSection
