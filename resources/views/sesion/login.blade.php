@extends('layout')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="page-title">Iniciar sesión</div>

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
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="group-form">
                <label for="cedula">Cédula</label>
                <input id="cedula" name="cedula" type="text" value="{{ old('cedula') }}" required autofocus>
            </div>

            <div class="group-form">
                <label for="clave">Clave</label>
                <input id="clave" name="clave" type="password" required>
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </div>
        </form>
    </div>
</div>
@endsection
