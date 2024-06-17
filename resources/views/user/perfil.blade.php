@extends('layouts.base')
@extends('layouts.header')
@extends('layouts.footer')

@section('head')
    <link rel="stylesheet" href="{{ asset('/assets/css/perfil.css') }}">

    <title>ShopXeng - Perfil</title>
@endSection

@section('content')
    @foreach ($user as $us)
        <main class="main">
            <div class="main__top">
                <div class="svg">
                    <svg class="svg__icon" viewBox="0 0 20 20">
                        <path class="svg__path" fill="none" d="M14.023,12.154c1.514-1.192,2.488-3.038,2.488-5.114c0-3.597-2.914-6.512-6.512-6.512
                            c-3.597,0-6.512,2.916-6.512,6.512c0,2.076,0.975,3.922,2.489,5.114c-2.714,1.385-4.625,4.117-4.836,7.318h1.186
                            c0.229-2.998,2.177-5.512,4.86-6.566c0.853,0.41,1.804,0.646,2.813,0.646c1.01,0,1.961-0.236,2.812-0.646
                            c2.684,1.055,4.633,3.568,4.859,6.566h1.188C18.648,16.271,16.736,13.539,14.023,12.154z M10,12.367
                            c-2.943,0-5.328-2.385-5.328-5.327c0-2.943,2.385-5.328,5.328-5.328c2.943,0,5.328,2.385,5.328,5.328
                            C15.328,9.982,12.943,12.367,10,12.367z"></path>
                    </svg>
                </div>

                <div class="main__data">
                    <h3 class="main__user">{{ $us->name }} {{ $us->surname }}</h3>
                    <p class="main__email">{{ $us->email }}</p>
                </div>
            </div>

            <div class="main__bot">
                <div class="content">

                    <a href="{{ route('pageInfo') }}" class="content__element">
                        <div class="content__logo">
                            <i class="content__icon bi bi-person-lines-fill"></i>
                        </div>

                        <div class="content__txt">
                            <h3 class="content__ttl">Información personal</h3>
                            <p class="content__sub">Información personal, documento de identidad, direcciones.</p>
                        </div>

                        <i class="content__arrow bi bi-chevron-right"></i>
                    </a>

                    <a href="{{ route('pageShopping') }}" class="content__element">
                        <div class="content__logo">
                            <i class="content__icon bi bi-bag"></i>
                        </div>

                        <div class="content__txt">
                            <h3 class="content__ttl">Mis compras</h3>
                            <p class="content__sub">Compras realizadas desde tu cuenta</p>
                        </div>

                        <i class="content__arrow bi bi-chevron-right"></i>
                    </a>

                </div>
            </div>
        </main>
    @endforeach
@endSection

@section('scripts')

@endSection
