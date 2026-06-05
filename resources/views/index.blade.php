@extends('layout')

@section('title', 'Clasificación de Jugadores')

@section('content')
<div class="container">
    <div class="page-title">Clasificación de Jugadores</div>

    <table>
        <thead>
            <tr>
                <th>Puesto</th>
                <th style="width: 35%;">Nombre</th>
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
                <tr @if($esActual) style="background-color: #eef7ff; font-weight: 600;" @endif>
                    <td>{{ $puesto }}</td>
                    <td>
                        <strong>{{ $usuario->nombre }}</strong>
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
</div>
@endsection
