@extends('layout.template')

@section('title', $title)

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">{{ $title }}</h1>
        <div class="card col-6">
            <div class="card-body">
                @if ($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" width="150">
                @endif
                <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
                <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                <p><strong>Precio:</strong> {{ $producto->precio }}</p>
                <p><strong>Cantidad:</strong> {{ $producto->cantidad }}</p>
                <p><strong>Categoría:</strong> {{ $producto->categoria->nombre ?? 'S/C' }}</p>
                <a href="{{ route('productos.index') }}" class="btn btn-primary mt-3">Volver atrás</a>
            </div>
        </div>
    </div>
