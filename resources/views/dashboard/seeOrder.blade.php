@extends('layouts.dash')

@section('head')
    <title>Dashboard | ShopXeng</title>
@endSection

@section('opOrders')
    class="active"
@endSection

@section('content')
    <main>
        <h1>Información detallada</h1>

        <!-- Recent Orders Table -->
        <div class="recent-orders">
            <h2>Pedido: 1</h2>
            <table>
                <thead>
                    <tr>
                        <th>Comprador</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Roger Omar Florez Garcia</td>
                        <td>Q&Q Hombre</td>
                        <td>3</td>
                        <td>En proceso</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End of Recent Orders -->

        <!-- Recent Orders Table -->
        <div class="recent-orders">
            <h2>Usuario: 1</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Cedula</th>
                        <th>correo</th>
                        <th>Direcciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Roger Omar</td>
                        <td>Florez Garcia</td>
                        <td>1002212675</td>
                        <td>roger_flasx@hotmail.com</td>
                        <td>
                            <form action="{{ route('pageDashUA') }}">
                                <button type="submit" class="recent-orders-btn"><i class='bx bx-map'></i></button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End of Recent Orders -->

        <!-- Recent Orders Table -->
        <div class="recent-orders">
            <h2>Producto Q&Q: 1</h2>
            <table>
                <thead>
                    <tr>
                        <th>Cristal</th>
                        <th>Caja</th>
                        <th>Pulsera</th>
                        <th>Manecillas</th>
                        <th>Agua</th>
                        <th>Garantia</th>
                        <th>Stock</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Cristal Mineral</td>
                        <td>Caja de acero horneado</td>
                        <td>Pulso en acero inoxidable</td>
                        <td>Hora, minutos y segundos</td>
                        <td>3 metros</td>
                        <td>5 meses</td>
                        <td>4</td>
                        <td>70.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End of Recent Orders -->

    </main>
@endSection

@section('scripts')
@endSection
