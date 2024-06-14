@extends('layouts.dash')

@section('head')
    <title>Dashboard | Nuevo Producto</title>
@endSection

@section('opProd')
    class="active"
@endSection

<!-- Mensaje de registro -->
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
    <main>
        <h1>Subir Imagen</h1>

        <div class="recent--form">
            <form action="{{ route('pageUploadP', $prod->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form__files"> 
                    <div class="form__header"> 
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M7 10V9C7 6.23858 9.23858 4 12 4C14.7614 4 17 6.23858 17 9V10C19.2091 10 21 11.7909 21 14C21 15.4806 20.1956 16.8084 19 17.5M7 10C4.79086 10 3 11.7909 3 14C3 15.4806 3.8044 16.8084 5 17.5M7 10C7.43285 10 7.84965 10.0688 8.24006 10.1959M12 12V21M12 12L15 15M12 12L9 15" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg>
                        <p>Browse File to upload!</p>
                    </div>
                    <label for="file" class="form__footer"> 
                        <p class="file-name">Not selected file</p>
                    </label> 
                    <input id="file" type="file" name="url[]" accept="image/webp" multiple style="display: none;">
                </div>

                <div class="form__content">
                    <button class="form__btn" type="submit">Subir Imagen</button>
                </div>
            </form>
        </div>
    </main>
@endSection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('file');
        const fileNameDisplay = document.querySelector('.file-name');

        // Mostrar nombres de archivos seleccionados
        fileInput.addEventListener('change', function() {
            const files = Array.from(fileInput.files);
            if (files.length > 0) {
                fileNameDisplay.textContent = files.map(file => file.name).join(', ');
            } else {
                fileNameDisplay.textContent = 'Not selected file';
            }
        });
    });
</script>
@endSection