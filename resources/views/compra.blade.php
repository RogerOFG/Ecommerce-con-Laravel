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

            <div class="cart__ubi">
                <div class="cart__icon">
                    <i class="cart__i bi bi-geo-alt"></i>
                </div>

                <div class="cart__address">
                    <div class="cart__content-address">
                        <span class="cart__span">Calle 50 #23-42</span>
                        <span class="cart__span">San Isidro - Barranquilla, Atlantico</span>
                    </div>
                </div>

                <div class="card__update">
                    <a class="card__update-link" href="#">Modificar dirección</a>
                </div>
            </div>

            <div class="cart__products">
                <h2>Productos pedidos</h2>

                @foreach ($cartItems as $item)
                    <div class="product">
                        <div class="product__ship">
                            <span class="product__ship-title">Costo de envio</span>
                            <span class="product__ship-op">Gratis</span>
                        </div>
                        <div class="product__data">
                            @php
                                $firstImage = $item->product->images->first();
                            @endphp
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
@endSection