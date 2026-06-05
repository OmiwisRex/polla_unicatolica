@extends('layout')

@section('title', 'Registro')

@section('content')
<div class="container">
    <div class="page-title">Registro de usuario</div>

    @if($errors->any())
        <div class="validation-errors">
            <strong>Corrige los siguientes errores:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">
        <form action="{{ route('registro') }}" method="POST">
            @csrf

            <div class="group-form">
                <label for="cedula">Cédula</label>
                <input id="cedula" name="cedula" type="text" value="{{ old('cedula') }}" required autofocus>
            </div>

            <div class="group-form">
                <label for="nombre">Nombre completo</label>
                <input id="nombre" name="nombre" type="text" value="{{ old('nombre') }}" required>
            </div>

            <div class="group-form">
                <label for="clave">Clave</label>
                <input id="clave" name="clave" type="password" required>
            </div>

            <div class="group-form">
                <label for="clave_confirmation">Confirmar clave</label>
                <input id="clave_confirmation" name="clave_confirmation" type="password" required>
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Registrar</button>
                <a href="{{ route('login') }}" class="btn btn-secondary">Ya tengo cuenta</a>
            </div>
        </form>
    </div>
</div>
@endsection
