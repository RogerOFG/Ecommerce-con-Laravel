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
        <div class="slider">
            <div class="slider__items">
                <img class="slider__item slider__img" src="{{ asset('/assets/img/slider/img-1.jpg') }}" alt="...">
                <img class="slider__item slider__img" src="{{ asset('/assets/img/slider/img-2.jpg') }}" alt="...">
                <img class="slider__item slider__img" src="{{ asset('/assets/img/slider/img-3.jpg') }}" alt="...">
            </div>

            <div class="slider__controls">
                <span class="slider__control slider__control--prev" onclick="changeSlide(-1)">
                    <i class="bx bxs-chevron-left"></i>
                </span>

                <span class="slider__control slider__control--next" onclick="changeSlide(1)">
                    <i class="bx bxs-chevron-right"></i>
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
    </main>
@endSection

@section('scripts')
{{-- SLIDER --}}
<script src="{{ asset('/assets/js/slider.js') }}"></script>
@endSection