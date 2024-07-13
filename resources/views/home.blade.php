@extends('layouts.base')
@extends('layouts.header')
@extends('layouts.footer')

@section('head')
    <link rel="stylesheet" href="{{ asset('/assets/css/home.css') }}">

    {{-- Kanit Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,500;0,600;0,700;0,800;0,900;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <title>ShopXeng - Home</title>
@endSection

@section('content')
    <main class="main">
        <div class="services offer">
            <img class="services__img--coupon" src="{{ asset('/assets/img/coupon/NUEVO20.png') }}" alt="...">

            <div class="services__wrapper-coupon">
                <div class="services__content-txt">
                    <h2 class="services__ttl">Obten un 10% de descuento en tu proxima compra</h2>
                    <p class="services__txt">¡Bienvenido a <b>ShopXeng</b>! Queremos celebrar tu visita ofreciéndote un descuento exclusivo del 10% en tu primera compra. Aprovecha esta oportunidad única para adquirir los mejores relojes a precios aún más accesibles.</p>
                </div>

                <div class="services__content-txt">
                    @if (auth()->check())
                        <a href="{{ route('pageCategory') }}" class="services__btn">Empieza a añadir productos</a>
                    @else
                        <a href="{{ route('login') }}" class="services__btn">Registrate</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="line"></div>

        <div class="slider">
            <div class="slider__items">
                <img class="slider__item slider__img" src="{{ asset('/assets/img/slider/img-1.jpg') }}" alt="...">
                <img class="slider__item slider__img" src="{{ asset('/assets/img/slider/img-2.jpg') }}" alt="...">
                <img class="slider__item slider__img" src="{{ asset('/assets/img/slider/img-3.jpg') }}" alt="...">
            </div>

            <div class="slider__controls">
                <span class="slider__control slider__control--prev" onclick="changeSlide(-1)">
                    <i class="bi bi-caret-left-fill"></i>
                </span>

                <span class="slider__control slider__control--next" onclick="changeSlide(1)">
                    <i class="bi bi-caret-right-fill"></i>
                </span>
            </div>

            <div class="slider__indicators">
                <span class="slider__indicator" onclick="moveTo(1)"></span>
                <span class="slider__indicator" onclick="moveTo(2)"></span>
                <span class="slider__indicator" onclick="moveTo(3)"></span>
            </div>

            <div class="slider__content">
                <h3 class="slider__text">Estilo</h3>
                <h3 class="slider__text">Elegancia</h3>
                <h3 class="slider__text">Calidad</h3>
            </div>
        </div>

        <div class="services services--txt">
            <h3 class="services__ttl services__ttl--center">Explora nuestra coleccion que combina estilo, elegancia y calidad inigualables.</h3>
        </div>

        <div class="line"></div>

        <div class="services">
            <h3 class="services__ttl">Lo que ofrecemos</h3>

            <div class="services__wrapper">
                <div class="services__content">
                    <div class="services__icon">📦</div>
    
                    <div class="services__right">
                        <h3 class="services__sub">Envíos GRATIS</h3>
                        <p class="services__txt">Disfruta de envíos gratis en todos nuestros productos. Sin costo adicional, sin preocupaciones.</p>
                    </div>
                </div>

                <div class="services__content">
                    <div class="services__icon">🛡️</div>
    
                    <div class="services__right">
                        <h3 class="services__sub">Protección de Datos</h3>
                        <p class="services__txt">Tu privacidad es nuestra prioridad. Mantenemos tus datos seguros y protegidos con la más alta tecnología de seguridad.</p>
                    </div>
                </div>

                <div class="services__content">
                    <div class="services__icon">🛠️</div>
    
                    <div class="services__right">
                        <h3 class="services__sub">Garantía de Calidad</h3>
                        <p class="services__txt">Nuestros productos están respaldados por una garantía para asegurar tu completa satisfacción, visita nuestras políticas para conocer mas.</p>
                    </div>
                </div>

                <div class="services__content">
                    <div class="services__icon">🚚</div>
    
                    <div class="services__right">
                        <h3 class="services__sub">Pago Contra Entrega</h3>
                        <p class="services__txt">Paga cómodamente al recibir tu pedido. Garantizamos un proceso de compra seguro y sin complicaciones.</p>
                    </div>
                </div>

                <div class="services__content">
                    <div class="services__icon">📞</div>
    
                    <div class="services__right">
                        <h3 class="services__sub">Atención al Cliente</h3>
                        <p class="services__txt">Nuestro equipo de atención al cliente está disponible para ayudarte con cualquier consulta o problema que puedas tener.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endSection

@section('scripts')
{{-- SLIDER --}}
<script src="{{ asset('/assets/js/slider.js') }}"></script>
@endSection