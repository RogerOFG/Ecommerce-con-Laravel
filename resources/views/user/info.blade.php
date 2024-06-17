@extends('layouts.base')
@extends('layouts.header')
@extends('layouts.footer')

@section('head')
    <link rel="stylesheet" href="{{ asset('/assets/css/perfil.css') }}">

    <title>ShopXeng - Perfil</title>
@endSection

@section('content')
    <main class="main">
        <h2 class="main__ttl">Administra tu información</h2>

        <div class="main__bot">
            <div class="ubi">
                <a class="ubi__link" href="{{ route('pagePerfil') }}">Perfil</a>
                <div class="ubi__sep">></div>
                <div class="ubi__link ubi__link--disabled">Información Personal</div>
            </div>
            <div class="content">

                <a href="{{ route('pageInfoF') }}" class="content__element">
                    <div class="content__logo">
                        <i class="content__icon bi bi-person-vcard"></i>
                    </div>

                    <div class="content__txt">
                        <h3 class="content__ttl">Datos pesonales</h3>
                        <p class="content__sub">Información de tu documento de identidad.</p>
                    </div>

                    <i class="content__arrow bi bi-chevron-right"></i>
                </a>

                <a href="{{ route('pageAccountF') }}" class="content__element">
                    <div class="content__logo">
                        <i class="content__icon bi bi-geo-alt"></i>
                    </div>

                    <div class="content__txt">
                        <h3 class="content__ttl">Direcciones</h3>    
                        <p class="content__sub">Direcciones guardadas en tu cuenta.</p>
                    </div>

                    <i class="content__arrow bi bi-chevron-right"></i>
                </a>

            </div>
        </div>
    </main>
@endSection

@section('scripts')

@endSection
