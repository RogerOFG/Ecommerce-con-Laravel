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
                    <i class='bx bxs-watch'></i>

                    <div class="info">
                        <h3>Productos agregados</h3>
                        <h1>19</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class='bx bxs-component'></i>

                    <div class="info">
                        <h3>Stock total</h3>
                        <h1>136</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class='bx bxs-cart'></i>

                    <div class="info">
                        <h3>Productos vendidos</h3>
                        <h1>36</h1>
                    </div>
                </div>
            </div>

            <div class="element element--hover">
                <div class="status">
                    <i class='bx bx-cart-add'></i>

                    <div class="info">
                        <h3>Nuevo</h3>
                        <h2>Producto</h2>
                    </div>
                </div>
            </div>
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
                    <tr>
                        <td>Q&Q</td>
                        <td>Q&Q Hombre</td>
                        <td>70.000</td>
                        <td>Cristal Mineral</td>
                        <td>Caja de acero horneado</td>
                        <td>Pulso en acero inoxidable</td>
                        <td>Hora, minutos y segundos</td>
                        <td>3 metros</td>
                        <td>5 meses</td>
                        <td>4</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End of Recent Orders -->

    </main>
@endSection

@section('scripts')
@endSection
