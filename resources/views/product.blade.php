@extends('layouts.base')
@extends('layouts.header')
@extends('layouts.footer')

@section('head')
    <link rel="stylesheet" href="{{ asset('/assets/css/product.css') }}">

    <title>ShopXeng - {{$product->name}}</title>
@endSection

@section('content')
    <main class="main">
        <div class="product">
            <div class="carousel">
                <div class="carousel__container">
                    <div class="carousel__thumbnails">
                        <div class="carrousel__thumbnail"></div>
                    </div>
                    <div class="carrousel__picture">
                        <img class="carrousel__img" id="main-image" src="">
                    </div>
                </div>

                @foreach ($images as $image)
                    <img  class="carrousel__thumbnailIMG" src="{{ asset('storage/img/products/' .'/'. $product->id .'/'. $image->url) }}" alt="Imagen del producto">
                @endforeach
            </div>

            <div class="infoProduct">
                <h2 class="infoProduct__title">{{$product->name}}</h2>
                <p class="infoProduct__price">$ {{ number_format($product->price, 0, '.', '.') }}</p> 
                <div>
                    <span> <i class="bi bi-truck"></i>  Los productos normalmente te llegaran de 2 a 5 días hábiles. </span> <br> <br>
                    <span class="infoProduct__alert">
                        <i class="bi bi-truck"></i>  
                        Pagos CONTRA ENTREGA. 
                        <i class="bi bi-patch-question-fill"></i>

                        <div class="infoProduct__quest">
                            Pagas cuando tengas el producto en tus manos.
                        </div>

                        <div class="infoProduct__amount">
                            Cantidad: 
                            <select id="amountProducts" onchange="amountChange()" class="infoProduct__select">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>

                            <span class="infoProduct__available">({{$product->amountAvailable}} disponibles)</span>
                        </div>

                        <div class="infoProduct__buttons">

                            <form action="{{ route('purchaseP') }}" method="POST">
                                @csrf
                                <input id="txtPurchaseAmount" name="amount" type="hidden">
                                <input name="idProduct" type="hidden" value="{{ $product->id }}">

                                <button class="infoProduct__btn">Comprar Ahora</button>
                            </form>

                            <form id="addToCartForm" action="{{ route('cartAdd', $product->id) }}" method="POST">
                                @csrf
                                <input id="txtAmount" name="amount" type="hidden">

                                <button id="addToCartBtn" class="infoProduct__btn infoProduct__btn--transparent">
                                    <span class="infoProduct__txt">Agregar al carrito</span>
                                    <span class="infoProduct__icon">
                                        <svg viewBox="0 0 16 16" class="bi bi-cart2" fill="currentColor" height="22" width="22" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"></path>
                                        </svg>
                                    </span>
                                </button>
                            </form>

                        </div>
                    </span>

                    <div class="data">
                        <strong class="data__title">Lo que tienes que saber de este producto</strong> <br><br>
                        <li class="data__li"> <strong>Marca:</strong> {{$product->brand}}</li>
                        <li class="data__li"> <strong>Manecillas:</strong> {{$product->manecillas}}</li>
                        <li class="data__li"> <strong>Material del cristal:</strong> {{$product->cristal}}</li>
                        <li class="data__li"> <strong>Caja: </strong> {{$product->caja}} <strong>(No es caja de presentación)</strong></li>
                        <li class="data__li"> <strong>Pulsera: </strong> {{$product->pulsera}}</li>
                        <li class="data__li"> Hora análoga</li>
                        @if ($product->metrosAgua != 0)
                            <li class="data__li"> Resistente al agua ({{$product->metrosAgua}}M de profundidad)</li>
                        @else
                            <li class="data__li"> No es resistente al agua</li>
                        @endif
                        <li class="data__li"> Garantia de {{$product->garanty}} Meses por defectos de fábrica y funcionamiento</li>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endSection

@section('scripts')
{{-- CARROUSEL DE FOTOS DEL PRODUCTO SELECCIONADO --}}
<script src="{{ asset('/assets/js/carrouselProduct.js') }}"></script>

<script>
    function amountChange(){
        const inputAmount = document.getElementById('amountProducts').value;
        const txtAmount = document.getElementById('txtAmount');
        const txtPurchaseAmount = document.getElementById('txtPurchaseAmount');

        txtAmount.value = inputAmount;
        txtPurchaseAmount.value = inputAmount;
    }

    amountChange();
</script>
@endSection
