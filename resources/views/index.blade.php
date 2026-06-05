@extends('layout')

@section('title', 'Bienvenido a Polla Unicatólica')

@section('content')
<div class="container">
    <div class="page-title">Bienvenid@</div>

    <p class="no-data">Administra el banco de preguntas de opción múltiple desde la sección de preguntas.</p>

    <div class="actions">
        <a href="{{ route('preguntas.index') }}" class="btn btn-primary btn-nav">Ir a Preguntas</a>
    </div>
</div>
@endsection
