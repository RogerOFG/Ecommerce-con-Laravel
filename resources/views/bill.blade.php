@extends('layouts.base')
@extends('layouts.header')
@extends('layouts.footer')

@section('head')
    <link rel="stylesheet" href="{{ asset('/assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/bill.css') }}">

    <title>ShopXeng - Factura</title>
@endSection

@section('content')
    <main class="main">
        <!-- Tables -->
        <div class="recent-orders recent-orders--tbody"> 
            <div class="table--ttl">Pedido realizado correctamente</div>
            <table>
                {{-- Products --}}
                @foreach ($products as $prod)
                <tbody>
                    <tr>
                        <td colspan="6"><h2>{{ $prod->name }}</h2></td>
                    </tr>

                    <tr>
                        <td class="title">Marca:</td>
                        <td>{{ $prod->brand }}</td>

                        <td class="title">Material del Cristal:</td>
                        <td>{{ $prod->cristal }}</td>
                    </tr>

                    <tr>
                        <td class="title">Material de la Caja:</td>
                        <td>{{ $prod->caja }}</td>

                        <td class="title">Material de la Pulsera:</td>
                        <td>{{ $prod->pulsera }}</td>
                    </tr>

                    <tr>
                        <td class="title">Garantia:</td>
                        <td>{{ $prod->garanty }} meses</td>

                        <td class="title">Precio:</td>
                        <td>{{ number_format($prod->price, 0, '.', '.') }}</td>
                    </tr>
                </tbody>
                @endforeach
                {{-- End of Product --}}

                {{-- Address --}}
                <tbody>
                    <tr>
                        <td colspan="6"><h2>Direccion de entrega</h2></td>
                    </tr>

                    <tr>
                        <td class="title">Ciudad:</td>
                        <td>{{ $address->city }}</td>

                        <td class="title">Departamento:</td>
                        <td>{{ $address->department }}</td>
                    </tr>

                    <tr>
                        <td class="title">Dirección:</td>
                        <td>{{ str_replace(['[', ']'], '', $address->address) }}</td>

                        <td class="title">Numero Casa:</td>
                        <td>{{ $address->number }}</td>
                    </tr>

                    <tr>
                        <td class="title">Barrio:</td>
                        <td>{{ $address->district }}</td>

                        <td class="title">Celular:</td>
                        <td>{{ $address->phone }}</td>
                    </tr>

                    <tr>
                        <td colspan="1" class="title">Información adicional:</td>
                        <td colspan="5">{{ $address->info }}</td>
                    </tr>
                </tbody>
                {{-- End of Address --}}
            </table>
        </div>
        <!-- End of Tables -->
    </main>
@endSection

@section('scripts')
@endSection
