@extends('layout')

@section('title', 'Buscar Jugador')

@section('content')
<div class="container">
    <div class="page-title">Buscar Jugador</div>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

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
        <form method="POST" action="{{ route('usuarios.search') }}">
            @csrf

            <div class="group-form">
                <label for="cedula">Cédula</label>
                <input id="cedula" name="cedula" type="text" value="{{ old('cedula', $cedula ?? '') }}" required autofocus>
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>

    @if(!empty($cedula))
        @if($usuario)
            <div class="form-card">
                <div class="group-form">
                    <label>Nombre</label>
                    <div>{{ $usuario->nombre }}</div>
                </div>
                <div class="group-form">
                    <label>Cédula</label>
                    <div>{{ $usuario->cedula }}</div>
                </div>
                <div class="group-form">
                    <label>Permiso</label>
                    <div>{{ $usuario->permiso?->nombre ?? 'Sin permiso' }}</div>
                </div>
                <div class="actions">
                    <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-secondary">Editar</a>
                </div>
            </div>
        @else
            <div class="validation-errors">
                No se encontró ningún jugador con la cédula {{ $cedula }}.
            </div>
        @endif
    @endif

    <div class="usuarios-table-panel">
        <div class="usuarios-table-section">
            <h3 class="table-section-title">Jugadores activos</h3>
            <table class="usuarios-table">
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jugadoresActivos as $usuarioActivo)
                        <tr>
                            <td>{{ $usuarioActivo->cedula }}</td>
                            <td>{{ $usuarioActivo->nombre }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">No hay jugadores activos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="usuarios-table-section inactive-users">
            <h3 class="table-section-title">Jugadores sin permiso</h3>
            <table class="usuarios-table">
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jugadoresInactivos as $usuarioInactivo)
                        <tr>
                            <td>{{ $usuarioInactivo->cedula }}</td>
                            <td>{{ $usuarioInactivo->nombre }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">No hay usuarios sin permiso registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
