@extends('layout.template')

@section('title', $title)

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">{{ $title }}</h1>
        <div class="card">
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
                <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                <p><strong>Precio:</strong> {{ $producto->precio }}</p>
                <p><strong>Cantidad:</strong> {{ $producto->cantidad }}</p>
                <a href="{{ route('productos.index') }}" class="btn btn-primary mt-3">Volver atrás</a>
            </div>
        </div>
    </div>
