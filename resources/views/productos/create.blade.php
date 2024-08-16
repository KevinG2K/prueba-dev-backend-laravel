@extends('layout.template')

@section('title', $title)

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">{{ $title }}</h1>
        <div class="col-6">
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio:</label>
                    <input type="text" name="precio" id="precio" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad:</label>
                    <input type="text" name="cantidad" id="cantidad" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="categoria_id" class="form-label">Categoría</label>
                    <select name="categoria_id" id="categoria_id" class="form-control">
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen</label>
                    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Crear</button>
                <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
