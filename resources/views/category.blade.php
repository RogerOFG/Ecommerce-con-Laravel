@extends('layouts.base')
@extends('layouts.header')
@extends('layouts.footer')

@section('head')
    <link rel="stylesheet" href="{{ asset('/assets/css/category.css') }}">

    <title>ShopXeng - Categorias</title>
@endSection

@section('content')
    <main class="main">
        <aside class="aside aside--open">
            <div class="aside__close aside__close--active">
                <div class="aside__barra aside__barra--first"></div>
                <div class="aside__barra aside__barra--last"></div>
            </div>
            <div class="aside__type">
                <div class="aside__line"></div>
                <h1 class="aside__title">Relojes</h1>
                
                <p class="aside__subt"><span class="aside__subt">-</span> Marca</p>
                <p class="aside__mark"><span class="aside__subt">-</span> Rolex</p>
                <p class="aside__mark"><span class="aside__subt">-</span> Patek</p>
                <p class="aside__mark"><span class="aside__subt">-</span> AP</p>
                <p class="aside__mark"><span class="aside__subt">-</span> Casio</p>
            </div>
        </aside>

        <div class="contentCards">
            
            @foreach ($products as $prod)
                <div class="card">
                    <a class="card__link" href="{{route('pageProduct', $prod->id)}}">
                        <div class="card__marco">
                            <div class="card__glass"></div>
                            @if ($prod->image)
                                <img class="card__picture" src="{{ asset('/storage/img/products/'.$prod->id.'/'.$prod->image->url) }}" alt="">
                            @endif
                        </div>
                    </a>
                        
                    <div class="card__content">
                        <div class="card__title">{{$prod->name}}</div>
                        <hr class="card__divider">
                        <div class="card__footer">
                            <div class="card__price">$ {{$prod->price}}</div>
                            <form action="{{ route('cartAdd', $prod->id) }}" method="POST">
                                @csrf
                                <button class="card__btnCart">
                                    <svg class="card__svgCart" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m397.78 316h-205.13a15 15 0 0 1 -14.65-11.67l-34.54-150.48a15 15 0 0 1 14.62-18.36h274.27a15 15 0 0 1 14.65 18.36l-34.6 150.48a15 15 0 0 1 -14.62 11.67zm-193.19-30h181.25l27.67-120.48h-236.6z"></path><path d="m222 450a57.48 57.48 0 1 1 57.48-57.48 57.54 57.54 0 0 1 -57.48 57.48zm0-84.95a27.48 27.48 0 1 0 27.48 27.47 27.5 27.5 0 0 0 -27.48-27.47z"></path><path d="m368.42 450a57.48 57.48 0 1 1 57.48-57.48 57.54 57.54 0 0 1 -57.48 57.48zm0-84.95a27.48 27.48 0 1 0 27.48 27.47 27.5 27.5 0 0 0 -27.48-27.47z"></path><path d="m158.08 165.49a15 15 0 0 1 -14.23-10.26l-25.71-77.23h-47.44a15 15 0 1 1 0-30h58.3a15 15 0 0 1 14.23 10.26l29.13 87.49a15 15 0 0 1 -14.23 19.74z"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endSection

@section('scripts')
<script>
    const btnSwitch = document.querySelector(".aside__close");
    const menu = document.querySelector(".aside");

    btnSwitch.addEventListener('click', function(){
        if(!btnSwitch.classList.contains('aside__close--active')){
            btnSwitch.classList.add('aside__close--active');
            menu.classList.add('aside--open');
        }else{
            btnSwitch.classList.remove('aside__close--active');
            menu.classList.remove('aside--open');
        }
    });
</script>
@endSection
