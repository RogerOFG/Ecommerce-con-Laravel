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
                                        <form id="myForm" class="element__content" action="{{ route('updateCart', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="element__btn incremento">+</button>
                                            <input id="amountChoose" class="element_num" type="hidden" value="{{ $item->amount }}">
                                            <input id="txtAmount" class="element_num" name="amount" type="text">
                                            <button class="element__btn decremento">-</button>
                                            <input class="element__max" type="hidden" value="{{ $item->product->amountAvailable }}">
                                        </form>
                                        <span class="element__available">{{ $item->product->amountAvailable }} disponibles</span>
                                    </div>

                                    <span class="element__price">${{ $item->product->price }}</span>
                                </div>

                                <div class="element__bot">
                                    <form action="{{ route('cartRemove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="element_a">Eliminar</button>
                                    </form>
                                    <a class="element_a" href="#">Comprar Ahora</a>
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
                        <span class="element__name element__name--empty">Inicia Sesión para empezar a usar el carrito</span>
                    </div>
                @endif

                @if(!$cartItems->isEmpty())
                    <div class="boxCart__continue">
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
        const input = document.getElementById('amountChoose').value;
        const txtAmount = document.getElementById('txtAmount');

        txtAmount.value = input;
    }

    amountChoose();

    const form = document.getElementById('myForm');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const suma = document.querySelector('.incremento');
        const resta = document.querySelector('.decremento');

        suma.disabled = true;
        suma.classList.add('element__btn--disabled');
        resta.disabled = true;
        resta.classList.add('element__btn--disabled');

        setTimeout(function() {
            form.submit();
        }, 500);
    });
</script>
@endSection
