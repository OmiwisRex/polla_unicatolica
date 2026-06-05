@extends('layout')

@section('title', 'Pago pendiente')

@section('content')
<div class="container">
    <div class="page-title">Pago pendiente</div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="form-card">
        <p>Tu cuenta ya existe, pero aún no tiene permiso de jugador. Por favor, dirígete con el administrador para realizar el pago y activar tu acceso.</p>
        <ul>
            <li>Luego de pagar, el administrador cambiaró tu permiso a <strong>Jugar</strong>.</li>
            <li>Hasta entonces solo podrás ver los partidos públicos.</li>
        </ul>

        <div class="actions">
            <a href="{{ route('partidos.index') }}" class="btn btn-secondary">Volver a Partidos</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-primary">Cerrar sesión</button>
            </form>
        </div>
    </div>
</div>
@endsection
