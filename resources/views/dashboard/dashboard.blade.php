@extends('layouts.dash')

@section('head')
    <title>Dashboard | ShopXeng</title>
@endSection

@section('opDash')
    class="active"
@endSection

@section('content')
    <main>
        <h1>Dashboard</h1>
        <!-- Analyses -->
        <div class="analyse">

            <div class="element">
                <div class="status">
                    <i class='bx bx-calendar-check'></i>

                    <div class="info">
                        <h3>Ventas totales</h3>
                        <h1>$65,024</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class='bx bxs-watch'></i>

                    <div class="info">
                        <h3>Productos vendidos</h3>
                        <h1>36</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class='bx bx-user-plus'></i>

                    <div class="info">
                        <h3>Registros</h3>
                        <h1>136</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class='bx bx-cart'></i>

                    <div class="info">
                        <h3>Ordenes</h3>
                        <h1>37</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Analyses -->

        <!-- Recent Orders Table -->
        <div class="recent-orders">
            <h2>Recent Orders</h2>
            <table>
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Course Number</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                </tbody>
            </table>
            <a href="#">Show All</a>
        </div>
        <!-- End of Recent Orders -->

    </main>
@endSection

@section('scripts')
@endSection
