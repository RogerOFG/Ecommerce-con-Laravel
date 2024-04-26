<<<<<<< HEAD
=======
@extends('layouts.base')
@extends('layouts.header')

@section('head')
    <link rel="stylesheet" href="{{ asset('/assets/css/compra.css') }}">

    {{-- Kanit Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,500;0,600;0,700;0,800;0,900;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <title>ShopXeng - Información de Compra</title>
@endSection

@section('content')
    <!-- SECTION -->
    <section class="section">
        <div class="cart">

            <div class="cart__title">
                <h2>Dirección de envío</h2>
            </div>

            @foreach ($cartItems as $item)
                @php
                    $shipments = $item->user->shipmentData;
                @endphp

                @if($shipments->isEmpty())
                    <a class="cart__a" href="{{ route('createAddress') }}">
                        <div class="cart__ubi cart__ubi--empty">
                            <div class="cart__empty">
                                <p class="cart__span">Añade la dirección a la que enviaremos tu pedido</p>
                            </div>
                        </div>
                    </a>
                @else
                    @foreach ($shipments as $shipment)
                    <div class="cart__ubi">
                        <label class="checkbox">
                            <input class="checkbox__input" type="checkbox">
                            <svg class="checkbox__svg" viewBox="0 0 64 64" height="2em" width="2em">
                                <path class="checkbox__path" d="M 0 16 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 16 L 32 48 L 64 16 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 16" pathLength="575.0541381835938"></path>
                            </svg>
                        </label>

                        <div class="cart__icon">
                            <i class="cart__i bi bi-geo-alt"></i>
                        </div>

                        <div class="cart__address">
                            <div class="cart__content-address">
                                <span class="cart__span">{{ $shipment->address }}</span>
                                <span class="cart__span">{{ $shipment->district }} - {{ $shipment->city }}, {{ $shipment->department }}</span>
                            </div>
                        </div>

                        <div class="card__update">
                            <a class="card__update-link" href="#">Modificar dirección</a>
                        </div>
                    </div>
                    @endforeach
                    <a href="{{ route('createAddress') }}">
                        <div class="cart__ubi cart__ubi--new">
                            <div class="cart__new">
                                <i class='cart__plus bx bx-plus-circle'></i>
                                <p class="cart__span cart__span--move">Añade una nueva dirección</p>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach

            <div class="cart__products">
                <h2>Productos pedidos</h2>

                @foreach ($cartItems as $item)
                    @php
                        $firstImage = $item->product->images->first();
                    @endphp
                    <div class="product">
                        <div class="product__ship">
                            <span class="product__ship-title">Costo de envio</span>
                            <span class="product__ship-op">Gratis</span>
                        </div>

                        <div class="product__data">
                            <div class="product__pic" style="background-image: url({{'/storage/img/products/'.$item->product->id.'/'.$firstImage->url}});"></div>
                            <div class="product__data-content">
                                <span class="product__span">{{ $item->product->name }}</span>
                                <span class="product__span">Cantidad: {{ $item->amount }}</span>
                                <span class="product__span">${{ $item->product->price }} c/u</span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer__content">
            <div class="footer__title">
                <span>Resumen de compra</span>
            </div>

            <div class="footer__box">
                <span>Producto/s (3)</span>
                <span>${{ $totalProducts }}</span>
            </div>

            <div class="footer__box footer__box--mb">
                <span>Envío</span>
                <span>$8.000</span>
            </div>

            <div class="footer__total">
                <span>Total</span>
                <span>${{ $totalToPay }} COP</span>
            </div>
        </div>
        <div class="footer__submit">
            <a class="footer__btn" href="#">Finalizar Compra</a>
        </div>
    </footer>
@endSection

@section('scripts')
<script src="{{ asset('/assets/js/compra.js') }}"></script>
@endSection
>>>>>>> da6e634 (changes)
