@extends('layout')

@section('title', 'Pago pendiente')

@section('content')
<div class="container">
    <div class="page-title">Pago pendiente</div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="form-card">
        <p>Tu cuenta ya existe, pero aún no tienes permiso para jugar. Por favor, dirígete a la oficina C200 del edificio de bienestar institucional.</p><br>
        <p>Allí verás a Ezequiel el coordinador de bienestar. Jugar tiene un costo de $5000 COP.</p><br>
        <p>Hasta entonces solo podrás ver los datos públicos.</p><br>
        <p>Recuerda que también puedes dirigirte al administrador para cambiar tu contraseña o nombre de jugador.</p>
    </div>
</div>
@endsection
