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

        <div class="featured">
            {{-- <h2>Mas vendidos</h2> --}}

            
        </div>

        {{-- <form id="contactForm">
            <input type="text" name="message" placeholder="Escribe tu mensaje aquí" required />
            <button type="submit">Enviar</button>
        </form> --}}
    </main>
@endSection

@section('scripts')
{{-- SLIDER --}}
<script src="{{ asset('/assets/js/slider.js') }}"></script>

{{-- <script>
    document.getElementById('contactForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const message = event.target.message.value;

        fetch('http://localhost:5000/send-message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ message })
        }).then(response => {
            if (response.ok) {
                alert('Mensaje enviado');
            } else {
                alert('Error enviando mensaje');
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    });
</script> --}}
@endSection