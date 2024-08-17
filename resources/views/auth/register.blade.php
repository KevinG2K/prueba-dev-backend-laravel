@extends('layout.template')

@section('title', $title)

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="{{ route('loginForm') }}" class="btn btn-secondary">
                    Volver
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">Registro de usuario</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Correo Electronico</label>
                                <input type="text" class="form-control" name="email">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Registrarse</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
