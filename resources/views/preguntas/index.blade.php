@extends('layout')

@section('title', 'Banco de Preguntas')

@section('content')
<div class="container">
    <div class="page-title">Banco de Preguntas</div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-danger">{{ session('error') }}</div>
    @endif

    <div class="control controlmax">
        <a href="{{ route('preguntas.create') }}" class="btn btn-primary btn-nav">Nueva pregunta</a>
        <span>{{ $preguntas->count() }} pregunta{{ $preguntas->count() === 1 ? '' : 's' }} activa{{ $preguntas->count() === 1 ? '' : 's' }}</span>
    </div>

    @if($preguntas->isEmpty())
        <p class="no-data">No hay preguntas activas en el banco.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Enunciado y respuesta correcta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($preguntas as $pregunta)
                    <tr>
                        <td>
                            <strong>{{ $pregunta->enunciado }}</strong>
                            <div class="answer">R: {{ $pregunta->correcta }}</div>
                        </td>
                        <td class="actions-cell">
                            <a href="{{ route('preguntas.edit', $pregunta) }}" class="btn btn-secondary">Editar</a>
                            <form action="{{ route('preguntas.destroy', $pregunta) }}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary" onclick="return confirm('¿Estás seguro de que deseas eliminar esta pregunta?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
