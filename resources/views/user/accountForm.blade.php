@extends('layouts.base')
@extends('layouts.header')
@extends('layouts.footer')

@section('head')
    <link rel="stylesheet" href="{{ asset('/assets/css/perfil.css') }}">

    <title>ShopXeng - Perfil</title>
@endSection

@section('content')
    <main class="main">
        <h2 class="main__ttl">Administra tu informaciónn</h2>

        <div class="main__bot">
            <div class="ubi">
                <a class="ubi__link" href="{{ route('pagePerfil') }}">Perfil</a>
                <div class="ubi__sep">></div>
                <a href="{{ route('pageInfo') }}" class="ubi__link">Información Personal</a>
                <div class="ubi__sep">></div>
                <div class="ubi__link ubi__link--disabled">Direcciones</div>
            </div>

            <div class="content">

                <a href="{{ route('createAddress') }}" class="content__element">
                    <div class="content__logo">
                        <i class='content__icon bx bx-plus'></i>
                    </div>

                    <div class="content__txt">
                        <h3 class="content__ttl">Nueva Direccion de entrega</h3>
                        <p class="content__sub">Añade una direccion de entrega.</p>
                    </div>

                    <i class='content__arrow bx bx-chevron-right'></i>
                </a>

                @if (!$shipments->isEmpty())
                    @foreach ($shipments as $shipment)
                        <div class="content__element">
                            <div class="content__logo">
                                <i class="content__icon bi bi-geo"></i>
                            </div>

                            <div class="content__txt">
                                <h3 class="content__sub">{{ $shipment->address }}</h3>
                                <p class="content__sub">{{ $shipment->district }} - {{ $shipment->city }}, {{ $shipment->department }}</p>
                            </div>

                            <i class='content__arrow content__arrow--fsz bx bxs-edit'></i>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </main>
@endSection

@section('scripts')

@endSection
