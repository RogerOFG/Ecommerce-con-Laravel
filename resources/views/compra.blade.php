@extends('layouts.base')
@extends('layouts.header')

@section('head')
    <link rel="stylesheet" href="{{ asset('/assets/css/compra.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/address.css') }}">

    {{-- Kanit Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,500;0,600;0,700;0,800;0,900;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <title>ShopXeng - Información de Compra</title>
@endSection

@section('content')
    <main id="formAddress" class="main">
        <div class="main__close" onclick="openFormAddress()">x</div>

        <h2 class="main__ttl">Añade una dirección</h2>

        <form class="inputs" action="{{ route('saveAddress') }}" method="POST">
            @csrf

            <input type="hidden" name="idUser" value="{{auth()->id()}}">

            <div class="inputs__wrapper">
                <div class="inputs__content inputs__content--two">
                    <input class="inputs__text" name="name" type="text" value="{{ $userData->name }}" required>
                    <label class="inputs__lbl">Nombre(s)</label>
                </div>

                <div class="inputs__content inputs__content--two">
                    <input class="inputs__text" name="surname" type="text" value="{{ $userData->surname }}" required>
                    <label class="inputs__lbl">Apellidos</label>
                </div>
            </div>

            <div class="inputs__wrapper">
                <div class="inputs__content inputs__content--two">
                    <input id="departamentos" class="inputs__text" name="department" type="text" autocomplete="false" required>
                    <div id="departContent" class="inputs__select inputs__select--hidde"></div>
                    <label class="inputs__lbl">Departamento</label>
                    <p class="inputs__error">Error: Debe elegir una de las opciones</p>
                </div>

                <div class="inputs__content inputs__content--two">
                    <input id="ciudades" class="inputs__text" name="city" type="text" autocomplete="false" required>
                    <div id="ciudContent" class="inputs__select inputs__select--hidde"></div>
                    <label class="inputs__lbl">Ciudad</label>
                    <p class="inputs__error">Error: Debe elegir una de las opciones</p>
                </div>
            </div>

            <div class="inputs__content">
                <input class="inputs__text" name="district" type="text" required>
                <label class="inputs__lbl">Barrio</label>
            </div>

            <div class="inputs__wrapper">
                <div class="inputs__content">
                    <select id="typeStreet" class="inputs__text inputs__text--width" onchange="newAddress()">
                        <option value="Avenida">Avenida</option>
                        <option value="Avenida Calle">Avenida Calle</option>
                        <option value="Avenida Carrera">Avenida Carrera</option>
                        <option value="Calle">Calle</option>
                        <option value="Carrera">Carrera</option>
                        <option value="Circular">Circular</option>
                        <option value="Circunvalar">Circunvalar</option>
                        <option value="Diagonal">Diagonal</option>
                        <option value="Manzana">Manzana</option>
                        <option value="Transversal">Transversal</option>
                        <option value="Vía">Vía</option>
                    </select>
                    <label class="inputs__lbl">Tipo de calle</label>
                </div>

                <div class="inputs__content">
                    <input id="streetNum" class="inputs__text inputs__text--width" type="number" oninput="newAddress()" required>
                    <label class="inputs__lbl">Calle / Carrera</label>
                </div>

                <div class="inputs__content inputs__content--symbol">
                    <p class="inputs__symbol">#</p>
                </div>

                <div class="inputs__content">
                    <input id="numFirst" class="inputs__text inputs__text--width" type="text" oninput="newAddress()" required>
                    <label class="inputs__lbl">Número</label>
                </div>

                <div class="inputs__content--symbol">
                    <p class="inputs__symbol">-</p>
                </div>

                <div class="inputs__content">
                    <input id="numSecond" class="inputs__text inputs__text--width" type="text" oninput="newAddress()" required>
                </div>
            </div>

            <div class="inputs__content">
                <input class="inputs__text" name="number" type="text" placeholder="Opcional">
                <label class="inputs__lbl">Piso/Departamento</label>
            </div>

            <div class="inputs__content">
                <input class="inputs__text" name="phone" type="text" required>
                <label class="inputs__lbl">Telefono de contacto</label>
            </div>

            <div class="inputs__content">
                <textarea class="inputs__text inputs__text--textarea" name="info" required></textarea>
                <label class="inputs__lbl">Referencias adicionales de esta dirección</label>
            </div>

            <input id="addressInput" name="address" type="hidden">

            <div class="inputs__submit">
                <button type="submit" class="inputs__btn">Guardar</button>
            </div>

        </form>
    </main>

    <div id="glass" class="glass"></div>

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
                    <div class="cart__a" onclick="openFormAddress()">
                        <div class="cart__ubi cart__ubi--empty">
                            <div class="cart__empty">
                                <p class="cart__span">Añade la dirección a la que enviaremos tu pedido</p>
                            </div>
                        </div>
                    </div>
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
                    {{-- <a href="{{ route('createAddress') }}"> --}}
                        <div class="cart__ubi cart__ubi--new" onclick="openFormAddress()">
                            <div class="cart__new">
                                <i class='cart__plus bx bx-plus-circle'></i>
                                <p class="cart__span cart__span--move">Añade una nueva dirección</p>
                            </div>
                        </div>
                    {{-- </a> --}}
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
<script src="{{ asset('/assets/js/colombia.js') }}"></script>
@endSection