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
                            <td class="btn-state cancel">Cancelado</td>
                        @elseif ($order->state == 1)
                            <td class="btn-state process">En proceso</td>
                        @elseif ($order->state == 2)
                            <td class="btn-state way">En camino</td>
                        @elseif ($order->state == 3)
                            <td class="btn-state delivered">Entregado</td>
                        @endif
                    </tr>

                    <tr class="element-tr">
                        <td class="change-state">
                            <form action="{{ route('pageDashOC', $order->id) }}" method="POST" class="disk">
                                @csrf

                                <input id="stateOrder" name="state" type="hidden">

                                <div class="up">
                                    <button class="card1">
                                        <i class="bi bi-hourglass-split"></i>
                                    </button>
                                    <button class="card2">
                                        <i class="bi bi-truck"></i>
                                    </button>
                                </div>
                                <div class="down">
                                    <button class="card3">
                                        <i class="bi bi-bag-x-fill"></i>
                                    </button>
                                    <button class="card4">
                                        <i class="bi bi-bag-check-fill"></i>
                                    </button>
                                </div>
                            </form>
                        </td>
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
<script>
    const stateOrder = document.getElementById('stateOrder');
    const btn1 = document.querySelector('.card1');
    const btn2 = document.querySelector('.card2');
    const btn3 = document.querySelector('.card3');
    const btn4 = document.querySelector('.card4');

    btn1.addEventListener('click', function(){
        stateOrder.value = 1;
    });
    btn2.addEventListener('click', function(){
        stateOrder.value = 2;
    });
    btn3.addEventListener('click', function(){
        stateOrder.value = 0;
    });
    btn4.addEventListener('click', function(){
        stateOrder.value = 3;
    });

    const btnState = document.querySelector('.btn-state');
    const changeState = document.querySelector('.change-state');

    btnState.addEventListener('click', function(){
        changeState.classList.toggle('active');
    });
</script>
@endSection
