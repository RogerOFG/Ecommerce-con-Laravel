@extends('layouts.dash')

@section('head')
    <title>Dashboard | ShopXeng</title>
@endSection

@section('opProd')
    class="active"
@endSection

@section('content')
    <main>
        {{-- Modal Image --}}
        <div id="modalImage" class="modal">
            <i id="modalClose" class="bi bi-x"></i>
            <picture class="modal__picture">
                <img id="imgPreview" class="modal__img" src="" alt="">
            </picture>
        </div>
        <input id="idProduct" type="hidden" value="{{ $product->id }}">
        {{-- End Modal Image --}}

        <h1>Modificar</h1>
        <!-- Analyses -->
        <div class="analyse">

            <div class="element">
                <div class="status">
                    <i class="bi bi-watch"></i>

                    <div class="info">
                        <h3>{{ $product->name }}</h3>
                        <h1>Producto</h1>
                    </div>
                </div>
            </div>

            <div class="element">
                <div class="status">
                    <i class="bi bi-bag"></i>

                    <div class="info">
                        <h3>{{ $product->brand }}</h3>
                        <h1>Marca</h1>
                    </div>
                </div>
            </div>

            <a href="{{ route('pageUpdateP', $product->id) }}" class="element element--hover">
                <div class="status">
                    <i class="bi bi-pencil-fill"></i>

                    <div class="info">
                        <h3>Producto</h3>
                        <h1>Modificar</h1>
                    </div>
                </div>
            </a>

            <a href="{{ route('pageImagesP', $product->id) }}" class="element element--hover">
                <div class="status">
                    <i class="bi bi-images"></i>

                    <div class="info">
                        <h3>Añadir</h3>
                        <h1>Imagenes</h1>
                    </div>
                </div>
            </a>

        </div>
        <!-- End of Analyses -->

        <!-- Recent Orders Table -->
        <div class="recent-orders">
            <h2>Imagen(es) del Producto</h2>

            <form action="{{ route('deleteProd', $product->id) }}" class="delete" method="POST">
                @csrf
                @method('DELETE')
                <button class="delete__btn">
                    <span class="delete__span delete__txt">Delete</span>
                    <span class="delete__span delete__icon">
                        <svg class="delete__svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path></svg>
                    </span>
                </button>
            </form>

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
                            <td class="recent-orders-td">
                                <div class="form__content-pic">
                                    <img class="form__picture" src="{{ asset('/storage/img/products/'.$product->id.'/'.$img->url) }}" data-image-url="{{ $img->url }}" data-product-id="{{ $product->id }}" alt="">
                                </div>
                            </td>
                            <td class="recent-orders-td">
                                <form action="{{ route('deleteImage', ['id' => $product->id, 'url' => $img->url]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="form__delete-pic" data-image-name="{{ $img->url }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
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
<script src="{{ asset('/assets/js/modalImage.js') }}"></script>
@endSection
