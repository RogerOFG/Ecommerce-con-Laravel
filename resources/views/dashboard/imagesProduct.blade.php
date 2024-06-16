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

        <h1>Imagen(es)</h1>
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

            <div class="element">
                <div class="status">
                    <i class="bi bi-box-seam-fill"></i>

                    <div class="info">
                        <h3>{{ $product->category }}</h3>
                        <h1>Categoria</h1>
                    </div>
                </div>
            </div>

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
                                    <img class="form__picture" src="{{ asset('/storage/img/products/'.$product->id.'/'.$img->url) }}" data-image-url="{{ $img->url }}" data-product-id="{{ $product->id }}" alt="">
                                </div>
                            </td>
                            <td>
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
