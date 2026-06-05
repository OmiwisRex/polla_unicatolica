@extends('layout')

@section('title', 'Clasificación de Jugadores')

@section('content')
<div class="container">
    <div class="page-title">Clasificación de Jugadores</div>

    <p class="no-data">El ranking se arma con los puntos de apuestas y preguntas guardados en el perfil de cada jugador.</p>

    <table>
        <thead>
            <tr>
                <th>Puesto</th>
                <th>Nombre</th>
                <th>Puntos apuestas</th>
                <th>Puntos preguntas</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usuarios as $index => $usuario)
                @php
                    $puesto = $index + 1;
                    $esActual = auth()->check() && auth()->user()->id === $usuario->id;
                @endphp
                <tr class="{{ $esActual ? 'row-highlighted' : '' }}">
                    <td>{{ $puesto }}</td>
                    <td>
                        <strong>{{ $usuario->nombre }}</strong>
                        @if($esActual)
                            <span class="tag">Tú</span>
                        @endif
                    </td>
                    <td>{{ number_format($usuario->pts_apuestas, 0, ',', '.') }}</td>
                    <td>{{ number_format($usuario->pts_preguntas, 0, ',', '.') }}</td>
                    <td>{{ number_format($usuario->total_pts, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="no-data">No hay jugadores registrados para mostrar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="actions">
        @guest
            <a href="{{ route('login') }}" class="btn btn-primary btn-nav">Iniciar sesión</a>
        @else
            @if(auth()->user()->permiso_id === 3)
                <a href="{{ route('partidos.admin') }}" class="btn btn-primary btn-nav">Ir a Partidos Admin</a>
            @elseif(auth()->user()->permiso_id === 2)
                <a href="{{ route('partidos.jugador') }}" class="btn btn-primary btn-nav">Ir a Mis Partidos</a>
            @else
                <a href="{{ route('pagar') }}" class="btn btn-primary btn-nav">Pagar para activar</a>
            @endif
        @endguest
    </div>
</div>
@endsection
