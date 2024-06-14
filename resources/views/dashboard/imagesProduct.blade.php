@extends('layouts.dash')

@section('head')
    <title>Dashboard | ShopXeng</title>
@endSection

@section('opUser')
    class="active"
@endSection

@section('content')
    <main>
        <h1>Imagen(es)</h1>
        <!-- Analyses -->
        <div class="analyse">

            <div class="element">
                <div class="status">
                    <i class='bx bx-user'></i>

                    <div class="info">
                        <h3>{{ $product->name }}</h3>
                        <h1>Producto</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class='bx bx-calendar'></i>

                    <div class="info">
                        <h3>{{ $product->brand }}</h3>
                        <h1>Marca</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class='bx bxs-user-badge'></i>

                    <div class="info">
                        <h3>{{ $product->category }}</h3>
                        <h1>Categoria</h1>
                    </div>
                </div>
            </div>

            <a href="{{ route('registerAdmin') }}" class="element element--hover">
                <div class="status">
                    <i class='bx bx-user-plus'></i>

                    <div class="info">
                        <h3>{{ $product->amountAvailable }}</h3>
                        <h1>Stock</h1>
                    </div>
                </div>
            </a>

        </div>
        <!-- End of Analyses -->

        <!-- Recent Orders Table -->
        <div class="recent-orders">
            <h2>Imagen(es) del Producto</h2>

            <table>
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($images as $img)
                        <tr>
                            <td>
                                <div class="form__content-pic">
                                    <img class="form__picture" src="{{ asset('/storage/img/products/'.$product->id.'/'.$img->url) }}" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="form__delete-pic">
                                    <i class="bi bi-trash"></i>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- End of Recent Orders -->
    </main>
@endSection

@section('scripts')
@endSection
