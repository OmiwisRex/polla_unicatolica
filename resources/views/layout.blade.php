<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Polla Unicatólica')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <div class="header-content">
            <div>
                <div class="logo">Polla Unicatólica</div>
                <div class="logo-subtitle">Banco de preguntas de opción múltiple</div>
            </div>
            <nav>
                <a href="{{ url('/') }}" class="btn btn-secondary">Inicio</a>
                <a href="{{ route('preguntas.index') }}" class="btn btn-secondary">Preguntas</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>