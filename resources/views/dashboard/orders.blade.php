@extends('layouts.dash')

@section('head')
    <title>Dashboard | ShopXeng</title>
@endSection

@section('opOrders')
    class="active"
@endSection

@section('content')
    <main>
        <h1>Pedidos</h1>

        <!-- Analyses -->
        <div class="analyse analyse--three">

            <div class="element">
                <div class="status">
                    <i class='bx bxs-cart'></i>

                    <div class="info">
                        <h3>Pedidos Totales</h3>
                        <h1>47</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class='bx bxs-calendar'></i>

                    <div class="info">
                        <h3>Pedidos del día</h3>
                        <h1>8</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class='bx bxs-inbox'></i>

                    <div class="info">
                        <h3>Pedidos en proceso</h3>
                        <h1>2</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class='bx bxs-truck'></i>

                    <div class="info">
                        <h3>Pedidos en camino</h3>
                        <h1>6</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class='bx bx-calendar-x'></i>

                    <div class="info">
                        <h3>Pedidos cancelados</h3>
                        <h1>2</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Analyses -->

        <!-- Recent Orders Table -->
        <div class="recent-orders">
            <h2>Pedidos Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Comprador</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Estado</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Roger Omar Florez Garcia</td>
                        <td>Q&Q Hombre</td>
                        <td>3</td>
                        <td>En proceso</td>
                        <td>
                            <form action="{{ route('pageDashOS') }}">
                                <button type="submit" class="recent-orders-btn">
                                    <i class='bx bx-search-alt'></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End of Recent Orders -->

    </main>
@endSection

@section('scripts')
@endSection
