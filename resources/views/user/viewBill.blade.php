@extends('layouts.base')
@extends('layouts.header')
@extends('layouts.footer')

@section('head')
    <link rel="stylesheet" href="{{ asset('/assets/css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/bill.css') }}">

    <title>ShopXeng - Factura</title>
@endSection

@section('content')
    <main class="main main--pdd">
        <div class="main__bot main__bot--pdd">
            <div class="ubi">
                <a class="ubi__link" href="{{ route('pagePerfil') }}">Perfil</a>
                <div class="ubi__sep">></div>
                <a class="ubi__link" href="{{ route('pageShopping') }}">Mis compras</a>
                <div class="ubi__sep">></div>
                <div class="ubi__link ubi__link--disabled">Factura</div>
            </div>
        </div>
            <div class="order">
                <div class="order__top">
                    <h3 class="order__ttl">Pedido #{{ $bill->idBill }}</h3>
                    <p id="dateCreate" class="order__date">{{ $bill->created_at }}</p>
                </div>
    
                <div class="order__mid">
                    <h3 class="order__sub">Detalles del pedido</h3>
                    @foreach ($products as $i => $prod)
                        <div class="order__element">
                            @if ($stateProd[$i] != 0)
                                <span class="order__name">{{ $prod->name }} x {{ $orders[$i]->amount }} <span class="order__italyc">(c/u ${{ number_format($prod->price, 0, '.', '.') }})</span></span>
                                <span class="order__price">${{ number_format($orders[$i]->amount * $prod->price) }}</span>
                            @else
                                <span class="order__name order__name--cancel">{{ $prod->name }} x {{ $orders[$i]->amount }} <span class="order__italyc">(c/u ${{ number_format($prod->price, 0, '.', '.') }})</span></span>
                                <span class="order__price order__price--cancel">${{ number_format($orders[$i]->amount * $prod->price) }}</span>
                            @endif
                        </div>
                    @endforeach
    
                    <div class="order__line"></div>
    
                    <div class="order__element">
                        <span class="order__name">Subtotal</span>
                        <span class="order__price">${{ number_format($subTotal) }}</span>
                    </div>
    
                    <div class="order__element">
                        <span class="order__name">Envio</span>
                        <span class="order__price">$0.0</span>
                    </div>
    
                    @if ($bill->discount != "NULL")
                        <div class="order__element">
                            <span class="order__name">Descuento aplicado</span>
                            <span class="order__price">{{ $bill->discount }}%</span>
                        </div>
                    @endif
    
                    <div class="order__element order__element--total">
                        <span class="order__weight">Total</span>
                        <span class="order__weight">${{ number_format($totalToPay) }}</span>
                    </div>
    
                    <div class="order__line"></div>
    
                    <div class="order__element order__element--group">
                        <div class="order__left">
                            <h3 class="order__sub">Información de envío</h3>
    
                            <div class="order__address">
                                <p>{{ $address->city }}</p>
                                <p>{{ $address->department }}</p>
                                <p>{{ str_replace(['[', ']'], '', $address->address) }}</p>
                                <p>{{ $address->number }}</p>
                                <p>{{ $address->district }}</p>
                                <p>{{ $address->phone }}</p>
                            </div>
                        </div>
    
                        <div class="order__line order__line--hidde"></div>
    
                        <div class="order__right">
                            <h3 class="order__sub">Información adicional</h3>
                            <p class="order__name">{{ $address->info }}</p>
                        </div>
                    </div>
    
                    <div class="order__line"></div>
    
                    <h3 class="order__sub">Información del cliente</h3>
    
                    <div class="order__element">
                        <span class="order__name">Cliente</span>
                        <span class="order__price">{{ $user->name }} {{ $user->surname }}</span>
                    </div>
    
                    <div class="order__element">
                        <span class="order__name">Correo electrónico</span>
                        <span class="order__price">{{ $user->email }}</span>
                    </div>
    
                    <div class="order__element">
                        <span class="order__name">Teléfono</span>
                        <span class="order__price">{{ $address->phone }}</span>
                    </div>
    
                    <div class="order__element">
                        <span class="order__name">Identificación</span>
                        <span class="order__price">{{ $user->numCC }}</span>
                    </div>
    
                    <div class="order__line"></div>
    
                    <h3 class="order__sub">Información de pago</h3>
    
                    <div class="order__element">
                        <span class="order__name">Pago contra entrega</span>
                        <span class="order__price">2 a 5 dias habiles</span>
                    </div>
                </div>
    
                <div class="order__bot">
                    <p>Estado: {{ $state }}</p>
    
                    @if ($state != "Cancelado")
                    <form action="{{ route('cancelBill', $bill->idBill) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="order__bot--cancel" type="submit">Cancelar el pedido</button>
                    </form>
                    @endif
                </div>
            </div>
    </main>
@endSection

@section('scripts')
<script>
    function formatDate(dateString) {
        // Crear un objeto Date a partir de la cadena de fecha
        const date = new Date(dateString);

        // Opciones para formatear la fecha
        const optionsDate = { 
            day: '2-digit', 
            month: 'long', 
            year: 'numeric' 
        };
        const optionsTime = { 
            hour: '2-digit', 
            minute: '2-digit' 
        };

        // Formatear la fecha y la hora por separado
        const formattedDate = date.toLocaleDateString('es-ES', optionsDate);
        const formattedTime = date.toLocaleTimeString('es-ES', optionsTime);

        // Devolver la fecha y hora formateadas
        return `Fecha: ${formattedDate} a las ${formattedTime}`;
    }

    // Obtener la fecha del elemento <p>
    const dateElement = document.getElementById('dateCreate');
    const dateString = dateElement.textContent;

    // Formatear la fecha y mostrarla en el elemento <p> de salida
    const formattedDate = formatDate(dateString);

    dateElement.textContent = formattedDate;
</script>
@endSection
