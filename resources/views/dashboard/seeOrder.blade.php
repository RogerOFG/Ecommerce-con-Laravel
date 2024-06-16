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

        <!-- Tables -->
        <div class="recent-orders recent-orders--tbody"> 
            <table>
                {{-- Order --}}
                <tbody>
                    <tr>
                        <td colspan="6"><h2>Pedido: {{ $order->id }}</h2></td>
                    </tr>

                    <tr>
                        <td class="title">Comprador:</td>
                        <td>{{ $order->user->name }} {{ $order->user->surname }}</td>

                        <td class="title">Producto:</td>
                        <td>{{ $order->prod->name }}</td>
                    </tr>

                    <tr>
                        <td class="title">Cantidad solicitada:</td>
                        <td>{{ $order->amount }}</td>

                        <td class="title">Estado:</td>
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
                {{-- End of Order --}}

                {{-- User --}}
                <tbody>
                    <tr>
                        <td colspan="6"><h2>Usuario: {{ $order->user->id }}</h2></td>
                    </tr>

                    <tr>
                        <td class="title">Nombre:</td>
                        <td>{{ $order->user->name }}</td>

                        <td class="title">Apellidos:</td>
                        <td>{{ $order->user->surname }}</td>
                    </tr>

                    <tr>
                        <td class="title">Cedula:</td>
                        <td>{{ $order->user->numCC }}</td>

                        <td class="title">correo:</td>
                        <td>{{ $order->user->email }}</td>
                    </tr>

                    <tr>
                        <td class="title">Direcciones:</td>
                        <td>
                            <form action="{{ route('pageDashUA', $order->user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="recent-orders-btn"><i class="bi bi-geo-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                {{-- End of User --}}

                {{-- Address --}}
                <tbody>
                    <tr>
                        <td colspan="6"><h2>Direccion del usuario: {{ $order->add->id }}</h2></td>
                    </tr>

                    <tr>
                        <td class="title">Ciudad:</td>
                        <td>{{ $order->add->city }}</td>

                        <td class="title">Departamento:</td>
                        <td>{{ $order->add->department }}</td>
                    </tr>

                    <tr>
                        <td class="title">Dirección:</td>
                        <td>{{ str_replace(['[', ']'], '', $order->add->address) }}</td>

                        <td class="title">Numero Casa:</td>
                        <td>{{ $order->add->number }}</td>
                    </tr>

                    <tr>
                        <td class="title">Barrio:</td>
                        <td>{{ $order->add->district }}</td>

                        <td class="title">Celular:</td>
                        <td>{{ $order->add->phone }}</td>
                    </tr>

                    <tr>
                        <td colspan="1" class="title">Información adicional:</td>
                        <td colspan="5">{{ $order->add->info }}</td>
                    </tr>
                </tbody>
                {{-- End of Address --}}

                {{-- Product --}}
                <tbody>
                    <tr>
                        <td colspan="6"><h2>Producto: {{ $order->prod->id }}</h2></td>
                    </tr>

                    <tr>
                        <td class="title">Marca:</td>
                        <td>{{ $order->prod->brand }}</td>

                        <td class="title">Material del Cristal:</td>
                        <td>{{ $order->prod->cristal }}</td>
                    </tr>

                    <tr>
                        <td class="title">Material de la Caja:</td>
                        <td>{{ $order->prod->caja }}</td>

                        <td class="title">Material de la Pulsera:</td>
                        <td>{{ $order->prod->pulsera }}</td>
                    </tr>

                    <tr>
                        <td class="title">Manecillas:</td>
                        <td>{{ $order->prod->manecillas }}</td>

                        <td class="title">Resistente al agua:</td>
                        <td>{{ $order->prod->metrosAgua }} metros</td>
                    </tr>

                    <tr>
                        <td class="title">Garantia:</td>
                        <td>{{ $order->prod->garanty }} meses</td>

                        <td class="title">Stock:</td>
                        <td>{{ $order->prod->amountAvailable }}</td>
                    </tr>

                    <tr>
                        <td class="title">Precio:</td>
                        <td>{{ number_format($order->prod->price, 0, '.', '.') }}</td>
                    </tr>
                </tbody>
                {{-- End of Product --}}
            </table>
        </div>
        <!-- End of Tables -->

    </main>
@endSection

@section('scripts')
@endSection
