@extends('layouts.dash')

@section('head')
    <title>Dashboard | ShopXeng</title>
@endSection

@section('opOrders')
    class="active"
@endSection

@section('content')
    <main>
        <h1>Información detallada</h1>

        <!-- Recent Orders Table -->
        <div class="recent-orders">
            <h2>Pedido: {{ $order->id }}</h2>
            <table>
                <thead>
                    <tr>
                        <th>Comprador</th>
                        <th>Producto</th>
                        <th>Cantidad solicitada</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order->user->name }} {{ $order->user->surname }}</td>
                        <td>{{ $order->prod->name }}</td>
                        <td>{{ $order->amount }}</td>
                        @if ($order->state == 0)
                            <td class="cancel">Cancelado</td>
                        @elseif ($order->state == 1)
                            <td class="process">En proceso</td>
                        @elseif ($order->state == 2)
                            <td class="way">En camino</td>
                        @elseif ($order->state == 3)
                            <td class="delivered">Entregado</td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End of Recent Orders -->

        <!-- Recent Orders Table -->
        <div class="recent-orders">
            <h2>Usuario: {{ $order->user->id }}</h2>
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
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->user->surname }}</td>
                        <td>{{ $order->user->numCC }}</td>
                        <td>{{ $order->user->email }}</td>
                        <td>
                            <form action="{{ route('pageDashUA', $order->user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="recent-orders-btn"><i class='bx bx-map'></i></button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End of Recent Orders -->

        <!-- Recent Orders Table -->
        <div class="recent-orders">
            <h2>Producto: {{ $order->prod->id }}</h2>
            <table>
                <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Cristal</th>
                        <th>Caja</th>
                        <th>Pulsera</th>
                        <th>Manecillas</th>
                        <th>Agua</th>
                        <th>Garantia</th>
                        <th>Stock</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order->prod->brand }}</td>
                        <td>{{ $order->prod->cristal }}</td>
                        <td>{{ $order->prod->caja }}</td>
                        <td>{{ $order->prod->pulsera }}</td>
                        <td>{{ $order->prod->manecillas }}</td>
                        <td>{{ $order->prod->metrosAgua }} metros</td>
                        <td>{{ $order->prod->garanty }} meses</td>
                        <td>{{ $order->prod->amountAvailable }}</td>
                        <td>{{ number_format($order->prod->price, 0, '.', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End of Recent Orders -->

    </main>
@endSection

@section('scripts')
@endSection
