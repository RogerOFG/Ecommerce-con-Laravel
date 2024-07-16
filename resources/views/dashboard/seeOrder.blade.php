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
                        <td colspan="6"><h2>Pedido: {{ $bill->idBill }}</h2></td>
                    </tr>
                    @foreach ($prods as $i => $prod)
                        <tr>
                            <td class="title">{{ $prod->name }} : {{ $prod->id }}</td>
                            <td>Cantidad: {{ $orders[$i]->amount }}</td>

                            <td class="title">Estado:</td>
                            @if ($orders[$i]->state == 0)
                                <td class="cancel">Cancelado</td>
                            @elseif ($orders[$i]->state == 1)
                                <td class="process">En proceso</td>
                            @elseif ($orders[$i]->state == 2)
                                <td class="way">En camino</td>
                            @elseif ($orders[$i]->state == 3)
                                <td class="delivered">Entregado</td>
                            @endif
                        </tr>

                        <tr>
                            <td>Precio: ${{ number_format($prod->price, 0, ".", ".") }}</td>

                            @if($orders[$i]->state != 0)
                                <td>Total: $ {{ number_format($orders[$i]->amount * $prod->price, 0, ".", ".") }}</td>
                            @else
                                <td class="order-cancel">$ 0.0</td>
                            @endif
                        </tr>
                    @endforeach

                    <tr class="recent-orders__pay">
                        <td class="title">Subtotal:</td>
                        <td>${{ number_format($bill->subtotal, 0, ".", ".") }}</td>

                        <td class="title">Descuento:</td>
                        <td>{{ $bill->discount }}</td>
                    </tr>

                    <tr class="recent-orders__pay">
                        <td class="title">Valor Total:</td>
                        <td class="total-pay">${{ number_format($bill->total, 0, ".", ".") }}</td>

                        <td class="title">Estado General:</td>
                        @if ($bill->state == 0)
                            <td class="btn-state cancel cancel--border">Cancelado</td>
                        @elseif ($bill->state == 1)
                            <td class="btn-state process process--border">En proceso</td>
                        @elseif ($bill->state == 2)
                            <td class="btn-state way way--border">En camino</td>
                        @elseif ($bill->state == 3)
                            <td class="btn-state delivered delivered--border">Entregado</td>
                        @endif
                    </tr>

                    <tr class="element-tr">
                        <td class="change-state">
                            <form action="{{ route('pageDashOC', $bill->idBill) }}" method="POST" class="disk">
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
                        <td colspan="6"><h2>Usuario: {{ $bill->user->id }}</h2></td>
                    </tr>

                    <tr>
                        <td class="title">Nombre:</td>
                        <td>{{ $bill->user->name }}</td>

                        <td class="title">Apellidos:</td>
                        <td>{{ $bill->user->surname }}</td>
                    </tr>

                    <tr>
                        <td class="title">Cedula:</td>
                        <td>{{ $bill->user->numCC }}</td>

                        <td class="title">correo:</td>
                        <td>{{ $bill->user->email }}</td>
                    </tr>

                    <tr>
                        <td class="title">Celular:</td>
                        <td>{{ $bill->add->phone }}</td>

                        <td class="title">Direcciones:</td>
                        <td>
                            <form action="{{ route('pageDashUA', $bill->user->id) }}" method="POST">
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
                        <td colspan="6"><h2>Direccion del usuario: {{ $bill->add->id }}</h2></td>
                    </tr>

                    <tr>
                        <td class="title">Ciudad:</td>
                        <td>{{ $bill->add->city }}</td>

                        <td class="title">Departamento:</td>
                        <td>{{ $bill->add->department }}</td>
                    </tr>

                    <tr>
                        <td class="title">Dirección:</td>
                        <td>{{ str_replace(['[', ']'], '', $bill->add->address) }}</td>

                        <td class="title">Numero Casa:</td>
                        <td>{{ $bill->add->number }}</td>
                    </tr>

                    <tr>
                        <td class="title">Barrio:</td>
                        <td>{{ $bill->add->district }}</td>
                    </tr>

                    <tr>
                        <td colspan="1" class="title">Información adicional:</td>
                        <td colspan="5">{{ $bill->add->info }}</td>
                    </tr>
                </tbody>
                {{-- End of Address --}}
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
