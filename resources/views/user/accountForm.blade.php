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
                <a href="{{ route('pageInfo') }}" class="ubi__link">Información Personal</a>
                <div class="ubi__sep">></div>
                <div class="ubi__link ubi__link--disabled">Direcciones</div>
            </div>

            <div class="content">

                

            </div>
        </div>
    </main>
@endSection

@section('scripts')

@endSection
