@extends('layouts.base')

@section('content')
    <form action="{{route('pageSaveP')}}" method="POST">
        @csrf
        <input name="name" type="text" placeholder="Nombre">

        <select name="category">
            <option disabled selected></option>
            <option value="Relojeria">Relojeria</option>
            <option value="Otros">Otros</option>
        </select>

        <select name="brand" id="">
            <option disabled selected></option>
            <option value="Q&Q">Q&Q</option>
            <option value="Rolex">Rolex</option>
            <option value="Cassio">Cassio</option>
        </select>

        <input name="price" type="text" placeholder="precio">

        <input name="cristal" type="text" placeholder="Material del Cristal">

        <input name="caja" type="text" placeholder="Material de la caja">

        <input name="pulsera" type="text" placeholder="Material de la pulsera">

        <select name="manecillas">
            <option value="Hora, minutos y segundos">Hora, minutos y segundos</option>
            <option value="Hora y minutos">Hora y minutos</option>
        </select>

        <input name="metrosAgua" type="text" placeholder="Metros bajo el agua" value="0">

        <input name="garanty" type="text" placeholder="Garantia en meses">

        <input name="amountAvailable" type="number" placeholder="Cantidad">

        <input type="submit" value="Guardar">
    </form>

    <a href="{{route('pageImagesP', 1)}}">Imagenes</a>
@endsection