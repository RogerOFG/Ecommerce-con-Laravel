@extends('layouts.base')

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
<h1>Subir Imagen</h1>

<form action="{{ route('pageUploadP', 1) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="imagen">Seleccionar imagen:</label>
    <input type="text" name="idProduct" value="{{$prod->id}}">
    <input type="file" name="url[]" accept="image/webp" multiple>

    <button type="submit">Subir Imagen</button>
</form>
@endsection