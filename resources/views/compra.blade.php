@extends('layouts.base')
@extends('layouts.header')

@section('head')
<link rel="stylesheet" href="{{ asset('/assets/css/compra.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/address.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                    <input class="inputs__text" name="name" type="text" value="{{ $userData->name }}" readonly>
                </div>

                <div class="inputs__content inputs__content--two">
                    <input class="inputs__text" name="surname" type="text" value="{{ $userData->surname }}" readonly>
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
                    <input id="streetNum" class="inputs__text inputs__text--width" type="text" oninput="newAddress()" required>
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

    <div id="alertAddress" class="alertAddress">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <span>Por favor escoja o añada una dirección a la que enviaremos su pedido</span>
    </div>

    <div id="alertContinue" class="alertContinue">
        <div class="alertContinue-contain">
            <span>¿Esta segur@ de que toda su Información es correcta?</span>
            
            <div class="alertContinue-option">
                <button id="confirmNo" class="alertContinue-btn alertContinue-btn--transparent">Creo que no</button>
                <button id="confirmYes" class="alertContinue-btn">Todo correcto</button>
            </div>
        </div>
    </div>

    <div id="glass" class="glass"></div>

    <!-- SECTION -->
    <section class="section">
        <div class="cart">

            <div class="cart__title">
                <h2>Dirección de envío</h2>
            </div>

            @if (isset($cartItems))
                @foreach ($cartItems as $item)
                    @php
                        $shipments = $item->user->shipmentData;
                    @endphp
                @endforeach

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
                                <input class="addressID" value="{{ $shipment->id }}" type="hidden">
                                <svg class="checkbox__svg" viewBox="0 0 64 64" height="2em" width="2em">
                                    <path class="checkbox__path" d="M 0 16 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 16 L 32 48 L 64 16 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 16" pathLength="575.0541381835938"></path>
                                </svg>
                            </label>

                            <div class="cart__icon">
                                <i class="cart__i bi bi-geo-alt"></i>
                            </div>

                            <div class="cart__address">
                                <div class="cart__content-address">
                                    <span class="cart__span">{{ str_replace(['[', ']'], '', $shipment->address) }}</span>
                                    <span class="cart__span">{{ $shipment->district }} - {{ $shipment->city }}, {{ $shipment->department }}</span>
                                </div>
                            </div>

                            <div class="card__update">
                                <a class="card__update-link" href="{{ route('editAddress', $shipment->id) }}">Modificar dirección</a>
                            </div>
                        </div>
                    @endforeach

                    <div class="cart__ubi cart__ubi--new" onclick="openFormAddress()">
                        <div class="cart__new">
                            <i class="cart__plus bi bi-plus-circle"></i>
                            <p class="cart__span cart__span--move">Añade una nueva dirección</p>
                        </div>
                    </div>
                @endif

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
                                <div class="product__pic" style="background-image: url({{ asset('/storage/img/products/'.$item->product->id.'/'.$firstImage->url) }});"></div>
                                <div class="product__data-content">
                                    <span class="product__span">{{ $item->product->name }}</span>
                                    <span class="product__span">
                                        Cantidad: 
                                        @if (isset($amountTotal))
                                            {{$item->amount = $amountTotal}}
                                        @else
                                            {{ $item->amount }}
                                        @endif
                                    </span>
                                    <span class="product__span">${{ number_format($item->product->price, 0, '.', '.') }} c/u</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="card__coupon">
                    <div class="coupon">
                        <div class="coupon__wrapper">
                            <span id="couponText" class="coupon__ttl">¿Tienes un codigo?</span>

                            <div class="coupon__content">
                                <input id="discount-code" class="coupon__input" type="text">
                                <button class="coupon__btn-search" type="submit" onclick="validateCoupon()"><i class="bi bi-search"></i></button>
                                <i class="coupon__cancel hidde bi bi-x" onclick="deleteCoupon()"></i>
                                <div id="couponLine" class="coupon__line"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer__content">
            <div class="footer__title">
                <span>Resumen de compra</span>
            </div>

            <div class="footer__box">
                <span>Producto/s ({{ isset($amountTotal) ? $amountTotal : $amount }})</span>
                <span>${{ number_format($totalProducts, 0, '.', '.') }}</span>
            </div>

            <div class="footer__box footer__box--mb">
                <span>Envío</span>
                <span>Gratis</span>
            </div>

            <div id="elementCoupon" class="footer__box footer__box--mb hidde">
                <span>Codigo de Descuento</span>
                <span id="valueCoupon">value</span>
            </div>

            <div class="footer__total">
                <span>Total</span>
                <span id="totalPayTxt">${{ number_format($totalToPay, 0, '.', '.') }} COP</span>
                <input id="totalPay" type="hidden" value="{{ $totalToPay }}">
            </div>
        </div>

        <form class="footer__submit" action="{{ route('finishP') }}" method="POST" onsubmit="return validateAddress()">
            @csrf
            {{-- ID DE LA DIRECCION ESCOGIDA --}}
            <input id="addressChoose" name="idAddress" type="hidden">

            {{-- TOKEN DE LA TRANSACIÓN --}}
            <input name="transactionToken" value="{{ $transactionToken }}" type="hidden">

            {{-- CODIGO DE DESCUENTO --}}
            <input id="codeDiscount" value="NULL" name="code" type="hidden">

            @foreach ($cartItems as $item)
                <input name="items[]" value="{{ json_encode(['id' => $item->product->id, 'amount' => $item->amount]) }}" type="hidden">
            @endforeach

            <input value="{{ $totalToPay }}" type="hidden">

            <button class="footer__btn" type="submit">Finalizar Compra</button>
        </form>
    </footer>
@endSection

@section('scripts')
<script>
    // LOADER
    var loader = document.querySelector(".loader");
    loader.style.display = "flex";
    
    window.addEventListener("load", function() {
        setTimeout(() => {
            var loader = document.querySelector(".loader");
            loader.style.display = "none";
        }, 1000);
    });

    function validateCoupon(){
        const input = document.getElementById('discount-code');
        const line = document.getElementById('couponLine');
        const msj = document.getElementById('couponText');
        const valueTxt = document.getElementById('valueCoupon');
        const elementCoupon = document.getElementById('elementCoupon');
        const totalPayTxt = document.getElementById('totalPayTxt');
        const totalPay = document.getElementById('totalPay').value;

        if(input.value.length > 0){
            line.classList.remove('error');

            $.ajax({
                url: "{{ route('searchCoupon') }}",
                method: 'GET',
                data: { query: input.value },
                success: function(data) {
                    if(data[0] == 0){
                        line.classList.add('error');
                        line.classList.remove('valid');
                        msj.innerHTML = "Codigo Invalido";
                        elementCoupon.classList.add('hidde');
                        totalPayTxt.innerHTML = '${{ number_format($totalToPay, 0, '.', '.') }} COP';
                    }else if(data[0] == 1){
                        // Guardamos el codigo ingresado en un input oculto
                        const codeDiscount = document.getElementById('codeDiscount');
                        codeDiscount.value = input.value;

                        // Escondemos el boton de buscar y aparece el de borrar
                        const btnCancel = document.querySelector('.coupon__cancel');
                        const btnSearch = document.querySelector('.coupon__btn-search');
                        btnCancel.classList.remove('hidde');
                        btnSearch.classList.add('hidde');

                        // Desactivamos el input
                        input.disabled = true;

                        line.classList.remove('error');
                        line.classList.add('valid');
                        msj.innerHTML = "Codigo Verificado";
                        elementCoupon.classList.remove('hidde');
                        valueTxt.innerHTML = data[1]+'%';

                        const porcentajeDescuento = data[1];
                        const descuentoAplicado = totalPay * (porcentajeDescuento / 100);
                        const nuevoTotal = totalPay - descuentoAplicado;

                        totalPayTxt.innerHTML = `${new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(nuevoTotal)} COP`;
                    }else if(data[0] == 2){
                        line.classList.add('error');
                        line.classList.remove('valid');
                        msj.innerHTML = "Codigo ya utilizado anteriormente";
                        elementCoupon.classList.add('hidde');
                        totalPayTxt.innerHTML = '${{ number_format($totalToPay, 0, '.', '.') }} COP';
                    }else if(data[0] == 3){
                        line.classList.add('error');
                        line.classList.remove('valid');
                        msj.innerHTML = "Codigo Descontinuado";
                        elementCoupon.classList.add('hidde');
                        totalPayTxt.innerHTML = '${{ number_format($totalToPay, 0, '.', '.') }} COP';
                    }
                },
                error: function() {
                    line.classList.add('error');
                    line.classList.remove('valid');
                    msj.innerHTML = "Ha ocurrido un error, pruebe mas tarde";
                }
            });
        }else{
            line.classList.add('error');
        }
    }

    function deleteCoupon(){
        const input = document.getElementById('discount-code');
        const btnCancel = document.querySelector('.coupon__cancel');
        const btnSearch = document.querySelector('.coupon__btn-search');
        const codeDiscount = document.getElementById('codeDiscount');
        const line = document.getElementById('couponLine');
        const msj = document.getElementById('couponText');
        const elementCoupon = document.getElementById('elementCoupon');
        const totalPayTxt = document.getElementById('totalPayTxt');
        
        codeDiscount.value = "NULL";
        input.value = "";
        input.disabled = false;
        btnCancel.classList.add('hidde');
        btnSearch.classList.remove('hidde');
        line.classList.remove('valid');
        msj.innerHTML = "¿Tienes un codigo?";

        elementCoupon.classList.add('hidde');
        totalPayTxt.innerHTML = '${{ number_format($totalToPay, 0, '.', '.') }} COP';
    }
</script>
<script src="{{ asset('/assets/js/compra.js') }}"></script>
<script src="{{ asset('/assets/js/colombia.js') }}"></script>
@endSection