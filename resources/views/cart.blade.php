@extends('layouts.base')
@extends('layouts.header')
@extends('layouts.footer')

@section('head')
    <link rel="stylesheet" href="{{ asset('/assets/css/cart.css') }}">

    <title>ShopXeng - Carrito</title>
@endSection

@section('content')
    <main class="main">
        <div class="boxCart">
            <h2 class="boxCart__title">Tu carrito</h2>

            <div class="boxCart__content">
                @if(auth()->check())
                    @if(!$cartItems->isEmpty())
                        @foreach ($cartItems as $item)
                            <div class="element">
                                <div class="element__top">
                                    @php
                                        $firstImage = $item->product->images->first();
                                    @endphp

                                    <img class="element__img" src="{{ asset('/storage/img/products/'.$item->product->id.'/'.$firstImage->url) }}" alt="">

                                    <span class="element__name">{{ $item->product->name }}</span>

                                    <div class="element__amount">
                                        <form class="element__content" action="{{ route('updateCart', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="element__btn incremento">+</button>
                                            <input class="element_num amountChoose" type="hidden" value="{{ $item->amount }}">
                                            <input class="element_num txtAmount" name="amount" type="text" readonly>
                                            <button class="element__btn decremento">-</button>
                                            <input class="element__max" type="hidden" value="{{ $item->product->amountAvailable }}">
                                        </form>
                                        <span class="element__available">{{ $item->product->amountAvailable }} disponibles</span>
                                    </div>

                                    <span class="element__price">${{ number_format($item->product->price, 0, '.', '.') }}</span>
                                </div>

                                <div class="element__bot">
                                    <form action="{{ route('cartRemove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="element_a">Eliminar</button>
                                    </form>

                                    <form action="{{ route('purchaseP') }}" method="POST">
                                        @csrf
                                        <input name="idProduct" type="hidden" value="{{ $item->product->id }}">
                                        <input name="amount" type="hidden" value="{{ $item->amount }}">
                                        <button type="submit" class="element_a">Comprar Ahora</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="element">
                            <span class="element__name element__name--empty">¡Tu carrito esta vacio!</span>
                            <span class="element__name element__name--empty">Empieza a añadir productos al carrito</span>
                        </div>
                    @endif
                @else
                    <div class="element">
                        <a href="{{ route('login') }}" class="element__name element__name--empty">Inicia Sesión para empezar a usar el carrito</a>
                    </div>
                @endif

                @if(!$cartItems->isEmpty())
                    <div class="boxCart__continue">
                        <span class="boxCart__subtotal">SubTotal: {{ number_format($subTotal, 0, '.', '.') }} COP</span>

                        <a href="{{ route('comprarCart') }}">
                            <button class="boxCart__btn" type="submit">Continuar compra</button>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endSection

@section('scripts')
<!-- INCREMENTO / DECREMENTO DE CATINDAD -->
<script>
    const cantidades = document.querySelectorAll('.element__content');

    cantidades.forEach(cantidad => {
        const botonRestar = cantidad.querySelector('.decremento');

        botonRestar.addEventListener('click', () => {
            const input = cantidad.querySelector('.element_num');

            let valor = parseInt(input.value);

            if (valor > 1) {
                valor--;
                input.value = valor;
                amountChoose();
            }
        });

        const botonSumar = cantidad.querySelector('.incremento');

        botonSumar.addEventListener('click', () => {
            // Encontrar el input correspondiente
            const input = cantidad.querySelector('.element_num');
            
            // Encontrar el elemento cant-max correspondiente
            const cantMax = cantidad.querySelector('.element__max');
            
            // Obtener el valor actual del input
            let valor = parseInt(input.value);
            
            // Obtener el valor máximo permitido
            let maximo = parseInt(cantMax.value);

            if (valor < maximo) {
                valor++;
                input.value = valor;
                amountChoose();
            }
        });
    });

    function amountChoose(){
        var forms = document.querySelectorAll('.element__content');

        forms.forEach(function(form) {
            var amountChoose = form.querySelector('.amountChoose');
            var txtAmount = form.querySelector('.txtAmount');

            txtAmount.value = amountChoose.value;

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const suma = form.querySelector('.incremento');
                const resta = form.querySelector('.decremento');

                suma.disabled = true;
                suma.classList.add('element__btn--disabled');
                resta.disabled = true;
                resta.classList.add('element__btn--disabled');

                setTimeout(function() {
                    form.submit();
                }, 500);
            });
        });
    }

    amountChoose();
</script>
@endSection
