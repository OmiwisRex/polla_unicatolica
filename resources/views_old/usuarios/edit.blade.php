@extends('layout')

@section('title', 'Editar Jugador')

@section('content')
<div class="container">
    <div class="page-title">Editar Jugador</div>

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
        <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="group-form">
                <label for="nombre">Nombre completo</label>
                <input id="nombre" name="nombre" type="text" value="{{ old('nombre', $usuario->nombre) }}" required>
            </div>

            @if($usuario->permiso_id !== 3)
                <div class="group-form">
                    <label for="permiso_id">Permiso</label>
                    <select id="permiso_id" name="permiso_id" required>
                        <option value="1" {{ old('permiso_id', $usuario->permiso_id) == 1 ? 'selected' : '' }}>Ninguno</option>
                        <option value="2" {{ old('permiso_id', $usuario->permiso_id) == 2 ? 'selected' : '' }}>Jugar</option>
                    </select>
                </div>
            @else
                <div class="group-form">
                    <label>Permiso</label>
                    <div>Administrar</div>
                </div>
            @endif

            <div class="group-form">
                <label for="clave">Nueva clave</label>
                <input id="clave" name="clave" type="password">
                <small>Dejar en blanco para mantener la clave actual.</small>
            </div>

            <div class="group-form">
                <label for="clave_confirmation">Confirmar clave</label>
                <input id="clave_confirmation" name="clave_confirmation" type="password">
            </div>

            <div class="actions">
                <a href="{{ route('usuarios.search', ['cedula' => $usuario->cedula]) }}" class="btn btn-secondary">Volver</a>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>
@endsection
