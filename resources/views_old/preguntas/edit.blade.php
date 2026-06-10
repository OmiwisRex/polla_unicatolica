@extends('layout')

@section('title', 'Editar Pregunta')

@section('content')
<div class="container">
    <div class="page-title">Editar pregunta</div>

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
        <form action="{{ route('preguntas.update', $pregunta) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="group-form">
                <label for="enunciado">Enunciado</label>
                <textarea id="enunciado" name="enunciado" required>{{ old('enunciado', $pregunta->enunciado) }}</textarea>
            </div>

            <div class="group-form">
                <label for="correcta">Respuesta correcta</label>
                <textarea id="correcta" name="correcta" required>{{ old('correcta', $pregunta->correcta) }}</textarea>
            </div>

            <div class="group-form">
                <label for="falsa1">Respuesta falsa 1</label>
                <textarea id="falsa1" name="falsa1" required>{{ old('falsa1', $pregunta->falsa1) }}</textarea>
            </div>

            <div class="group-form">
                <label for="falsa2">Respuesta falsa 2</label>
                <textarea id="falsa2" name="falsa2" required>{{ old('falsa2', $pregunta->falsa2) }}</textarea>
            </div>

            <div class="group-form">
                <label for="falsa3">Respuesta falsa 3</label>
                <textarea id="falsa3" name="falsa3" required>{{ old('falsa3', $pregunta->falsa3) }}</textarea>
            </div>

            <div class="actions">
                <a href="{{ route('preguntas.index') }}" class="btn btn-secondary">Volver</a>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>
@endsection
