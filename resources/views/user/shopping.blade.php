@extends('layouts.base')
@extends('layouts.header')
@extends('layouts.footer')

@section('head')
    <link rel="stylesheet" href="{{ asset('/assets/css/perfil.css') }}">

    <title>ShopXeng - Mis compras</title>
@endSection

@section('content')
    <div id="changeState" class="modal">
        <div class="modal__contain">
            <span>¿Esta segur@ de que desea cancelar el pedido?</span>
            
            <div class="modal__option">
                <button id="confirmNo" class="modal__btn modal__btn--transparent">Cancelar</button>
                <button id="confirmYes" class="modal__btn">Continuar</button>
            </div>
        </div>
    </div>

    <main class="main">
        <h2 class="main__ttl">Tus compras</h2>

        <div class="main__bot">
            <div class="ubi">
                <a class="ubi__link" href="{{ route('pagePerfil') }}">Perfil</a>
                <div class="ubi__sep">></div>
                <div class="ubi__link ubi__link--disabled">Mis compras</div>
            </div>

            <div class="content content--gap">
                @if (!$orders->isEmpty())
                    @foreach ($orders as $order)

                    <div class="content__element content__element--flex">
                        <div class="content__element-wrapper">
                            <div class="content__element--data">
                                <div class="content__picture">
                                    <img class="content__img" src="{{ asset('/storage/img/products/'.$order->img->idProduct.'/'.$order->img->url) }}" alt="">
                                </div>
                            
                                <div class="content__info">
                                    <h3 class="content__ttl">
                                        @if($order->state == 1)
                                            En proceso
                                        @elseif($order->state == 2)
                                            En camino
                                        @elseif($order->state == 3)
                                            Entregado
                                        @elseif($order->state == 0)
                                            Cancelado
                                        @endif
                                    </h3>
                                    <p class="content__sub content__sub--bold">{{ $order->prod->name }}</p>
                                    <p class="content__sub">{{ $order->amount }} unidad(es)</p>
                                </div>
                            </div>
                            
                            <div class="content__options">
                                <a href="{{route('pageProduct', $order->prod->id)}}">
                                    <button type="button" class="content__btn">Ver producto</button>
                                </a>
                            
                                <form action="{{ route('purchaseP') }}" method="POST">
                                    @csrf
                                    <input name="idProduct" type="hidden" value="{{ $order->prod->id }}">
                                    <input name="amount" type="hidden" value="1">
                            
                                    <button type="submit" class="content__btn content__btn--trasparent">Volver a comprar</button>
                                </form>
                            </div>
                        </div>
                        
                        @if($order->state == 1)
                            <form action="{{ route('changeState', $order->id) }}" method="POST" class="content__cancel" onsubmit="return changeOrder()">
                                @csrf
                                <input name="state" type="hidden" value="0">
                                <input name="amount" type="hidden" value="{{ $order->amount }}">
                                <button type="submit" class="content__cancel-btn">Cancelar pedido</button>
                            </form>
                        @endif
                    </div>

                    @endforeach
                @else
                    <div class="content__element content__element--none">
                        <p class="content__sub content__sub--bold">Aun no hay compras</p>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endSection

@section('scripts')
<script>
    function changeOrder(){
        const modal = document.getElementById('changeState');
        modal.classList.add('active');

        return false;
    }

    // Confirmar envio del formulario (Cancelar pedido)
    document.getElementById('confirmYes').addEventListener('click', function() {
        document.querySelector('.content__cancel').submit();
    });

    // Cancelar envio del formulario (Cancelar pedido)
    document.getElementById('confirmNo').addEventListener('click', function() {
        const modal = document.getElementById('changeState');
        modal.classList.remove('active');
    });
</script>
@endSection
