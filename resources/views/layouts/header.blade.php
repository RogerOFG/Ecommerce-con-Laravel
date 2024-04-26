@section('header')
<header class="header">
    <div class="header__logo">
        <a href="{{route('pageHome')}}">
            <svg class="header__logoSVG" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 474 456">
                <g transform="translate(-530 -25)">
                    <line x2="275" transform="translate(629 359.5)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="8"/>
                    <g transform="translate(102 -222)">
                    <g transform="translate(527 247)" fill="rgba(255,255,255,0)" stroke="#000" stroke-width="21">
                        <circle cx="137.5" cy="137.5" r="137.5" stroke="none"/>
                        <circle cx="137.5" cy="137.5" r="127" fill="none"/>
                    </g>
                    <path d="M550.492,349.768l121.99-75.353L554.635,425.76,740.59,295.667,594.141,470.3,769.025,341.715,645.977,490.178l133.868-88.071" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="34"/>
                    </g>
                    <text transform="translate(530 457)" font-size="90" font-family="ComicSansMS-Bold, Comic Sans MS" font-weight="700"><tspan x="0" y="0">SHOPXENG</tspan></text>
                </g>
            </svg>
        </a>
    </div>
    
    <nav class="header__nav">
        <ul class="header__ul">
            <li class="header__li"><a class="header__a" href="{{route('pageCategory')}}">Categorias</a></li>
            @if (Auth::check())
                <li class="header__li"><a class="header__a" href="#">{{ Auth::user()->name }}</a></li>
            @else
                <li class="header__li"><a class="header__a" href="{{route('login')}}">Ingresar</a></li>
            @endif
            <li class="header__li"><a class="header__a" href="#">Mis compras</a></li>
            <li class="header__li">
                <a class="header__a header__a--father" href="{{ route('pageCart') }}">
                    @if (Auth::check())
                        <div class="header_amountCart">{{ $totalAmount }}</div>
                    @else
                        <div class="header_amountCart">0</div>
                    @endif
                    <svg class="header__cart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35.132 24">
                        <line x2="6" transform="translate(0.5 0.5)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="2"/>
                        <line x2="7" y2="16" transform="translate(6.5 0.5)" fill="none" stroke="#fff" stroke-width="2"/>
                        <line x2="17" transform="translate(13.5 16.5)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="2"/>
                        <line x1="4" y2="12" transform="translate(30.5 4.5)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="2"/>
                        <g transform="translate(14 18)" fill="none" stroke="#fff" stroke-width="2">
                        <circle cx="3" cy="3" r="3" stroke="none"/>
                        <circle cx="3" cy="3" r="2.5" fill="none"/>
                        </g>
                        <g transform="translate(23 18)" fill="none" stroke="#fff" stroke-width="2">
                        <circle cx="3" cy="3" r="3" stroke="none"/>
                        <circle cx="3" cy="3" r="2.5" fill="none"/>
                        </g>
                    </svg>

                    <div class="carrito">
                        <div class="carrito__wrapper">
                            @if(auth()->check())
                                @if(!$cartItems->isEmpty())
                                    @foreach ($cartItems as $item)
                                        <div class="carrito__content">
                                            <div class="carrito__pic">
                                                @php
                                                    $firstImage = $item->product->images->first();
                                                @endphp

                                                <img class="carrito__img" src="{{ asset('/storage/img/products/'.$item->product->id.'/'.$firstImage->url) }}" alt="">
                                            </div>
                                            <span class="carrito__name"> {{ $item->product->name }}</span>
                                            <span class="carrito__precio">COP{{ $item->product->price }}</span>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="carrito__content">
                                        <span class="carrito__name carrito__name--empty">¡Tu carrito esta vacio!</span>
                                    </div>
                                @endif
                            @else
                                <div class="carrito__content">
                                    <span class="carrito__name carrito__name--empty">Inicia Sesión para empezar a usar el carrito</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            </li>

            @if (Auth::check())
                @if (Auth::user()->admin == 1)
                <li class="header__li"><a class="header__a" href="{{route('pageCreateP')}}">Dashboard</a></li>
                @endif

                <li class="header__li">
                    <a class="header__a" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-left"></i>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </li>
            @endif
        </ul>
    </nav>
</header>
@endSection