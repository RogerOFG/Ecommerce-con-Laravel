@extends('layouts.dash')

@section('head')
    <title>Dashboard | ShopXeng</title>
@endSection

@section('opProd')
    class="active"
@endSection

@section('content')
    <main>
        <h1>Productos</h1>

        <!-- Analyses -->
        <div class="analyse">

            <div class="element">
                <div class="status">
                    <i class="bi bi-watch"></i>

                    <div class="info">
                        <h3>Productos agregados</h3>
                        <h1>{{ $totalProd }}</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class="bi bi-boxes"></i>

                    <div class="info">
                        <h3>Stock total</h3>
                        <h1>{{ $stock }}</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class="bi bi-cart-check"></i>

                    <div class="info">
                        <h3>Productos vendidos</h3>
                        <h1>{{ $totalPS }}</h1>
                    </div>
                </div>
            </div>

            <a href="{{ route('pageCreateP') }}" class="element element--hover">
                <div class="status">
                    <i class="bi bi-cart-plus"></i>

                    <div class="info">
                        <h3>Nuevo</h3>
                        <h2>Producto</h2>
                    </div>
                </div>
            </a>
        </div>
        <!-- End of Analyses -->

        <!-- Recent Orders Table -->
        <div class="recent-orders">
            <h2>Productos Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cristal</th>
                        <th>Caja</th>
                        <th>Pulsera</th>
                        <th>Manecillas</th>
                        <th>Agua</th>
                        <th>Garantia</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                        <tr>
                            <td>{{ $item->brand }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ number_format($item->price, 0, '.', '.') }}</td>
                            <td>{{ $item->cristal }}</td>
                            <td>{{ $item->caja }}</td>
                            <td>{{ $item->pulsera }}</td>
                            <td>{{ $item->manecillas }}</td>
                            <td>{{ $item->metrosAgua }}</td>
                            <td>{{ $item->garanty }}</td>
                            <td>{{ $item->amountAvailable }}</td>
                            <td>
                                <form action="{{ route('pageShowI', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="recent-orders-btn">
                                        <i class="bi bi-nut"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- End of Recent Orders -->

        {{ $products->links('layouts.pagination') }}

    </main>
@endSection

@section('scripts')
@endSection
