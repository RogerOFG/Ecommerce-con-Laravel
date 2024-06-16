@extends('layouts.dash')

@section('head')
    <title>Dashboard | ShopXeng</title>
@endSection

@section('opUser')
    class="active"
@endSection

@section('content')
    <main>
        <h1>Usuario</h1>
        <!-- Analyses -->
        <div class="analyse analyse--three">

            <div class="element">
                <div class="status">
                    <i class="bi bi-person"></i>

                    <div class="info">
                        <h2>Nombre</h2>
                        <h3>{{ $user->name }} {{ $user->surname }}</h3>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class="bi bi-envelope-at"></i>

                    <div class="info">
                        <h2>Correo</h3>
                        <h3>{{ $user->email }}</h3>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class="bi bi-person-vcard"></i>

                    <div class="info">
                        <h2>Cedula</h3>
                        <h3>{{ $user->numCC }}</h3>
                    </div>
                </div>
            </div>

        </div>
        <!-- End of Analyses -->

        <!-- Recent Orders Table -->
        <div class="recent-orders">
            <h2>Direccion(es) del usuario</h2>
            <table>
                <thead>
                    <tr>
                        <th>Ciudad</th>
                        <th>Departamento</th>
                        <th>Barrio</th>
                        <th>Dirección</th>
                        <th>Info</th>
                        <th>Numero Casa</th>
                        <th>Celular</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($addresses as $address)
                        <tr>
                            <td>{{ $address->city }}</td>
                            <td>{{ $address->department }}</td>
                            <td>{{ $address->district }}</td>
                            <td>{{ str_replace(['[', ']'], '', $address->address) }}</td>
                            <td>{{ $address->info }}</td>
                            <td>{{ $address->number }}</td>
                            <td>{{ $address->phone }}</td>
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
