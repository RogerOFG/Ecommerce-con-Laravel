@extends('layouts.dash')

@section('head')
    <title>Dashboard | ShopXeng</title>
@endSection

@section('opOrders')
    class="active"
@endSection

@section('content')
    <main>
        <h1>Pedidos</h1>

        <!-- Analyses -->
        <div class="analyse analyse--three">

            <div class="element">
                <div class="status">
                    <i class="bi bi-cart3"></i>

                    <div class="info">
                        <h3>Pedidos Totales</h3>
                        <h1>{{ $totalOrders }}</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class="bi bi-calendar-event"></i>

                    <div class="info">
                        <h3>Pedidos del día</h3>
                        <h1>{{ $totalOrdersT }}</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class="bi bi-inbox-fill"></i>

                    <div class="info">
                        <h3>Pedidos en proceso</h3>
                        <h1>{{ $totalOrdersP }}</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class="bi bi-truck"></i>

                    <div class="info">
                        <h3>Pedidos en camino</h3>
                        <h1>{{ $totalOrdersW }}</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class="bi bi-bag-check-fill"></i>

                    <div class="info">
                        <h3>Pedidos completados</h3>
                        <h1>{{ $totalOrdersF }}</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class="bi bi-calendar-x"></i>

                    <div class="info">
                        <h3>Pedidos cancelados</h3>
                        <h1>{{ $totalOrdersC }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Analyses -->

        <!-- Recent Orders Table -->
        <div class="recent-orders">
            <h2>Pedidos Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Comprador</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                        <th>Tiempo Limite</th>
                        <th>Estado</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)
                        <tr>
                            <td>{{ $item->user->name }} {{ $item->user->surname }}</td>
                            <td>{{ $item->prod->name }}</td>
                            <td>{{ $item->amount }}</td>
                            <td class="datesCreate">{{ $item->created_at }}</td>
                            <td class="timeAvailable">5 dias habiles</td>
                            @if ($item->state == 0)
                                <td class="cancel">Cancelado</td>
                            @elseif ($item->state == 1)
                                <td class="process">En proceso</td>
                            @elseif ($item->state == 2)
                                <td class="way">En camino</td>
                            @elseif ($item->state == 3)
                                <td class="delivered">Entregado</td>
                            @endif
                            <td>
                                <form action="{{ route('pageDashOS', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="recent-orders-btn">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- End of Recent Orders -->

    </main>
@endSection

@section('scripts')
<script src="{{ asset('/assets/js/ordersDate.js') }}"></script>
@endSection
