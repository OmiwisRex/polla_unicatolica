<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="partidos-base-url" content="{{ url('/partidos') }}">
    <title>@yield('title', 'Reto Mundialista')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { background-image: url('{{ asset("img/fondomundial.png") }}'); }</style>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>
<body>
    <header>
        <div class="header-content">
            <div>
                <img src="{{ asset('img/horizontal_fullcolor.png') }}" alt="Logo Institución" class="navbar-logo">
                <div class="logo-subtitle">Reto Mundialista 2026 + Trivia Institucional</div>
            </div>

            <div class="controls_header">
                <a href="{{ route('index') }}" class="btn btn-secondary">Clasificación</a>
                <a href="{{ auth()->check() && auth()->user()->permiso_id === 2 ? route('partidos.jugador') : (auth()->check() && auth()->user()->permiso_id === 3 ? route('partidos.admin') : route('partidos.index')) }}" class="btn btn-secondary">Partidos</a>
                @auth
                    @if(auth()->user()->permiso_id === 3)
                        <a href="{{ route('preguntas.index') }}" class="btn btn-secondary">Preguntas</a>
                        <a href="{{ route('usuarios.search') }}" class="btn btn-secondary">Jugadores</a>
                    @endif
                    @if(auth()->user()->permiso_id === 1)
                        <a href="{{ route('pagar') }}" class="btn btn-secondary">Pagar</a>
                    @endif
                @endauth
                <button type="button" class="btn btn-secondary" onclick="openHelpModal()">?</button>
            </div>

            <div>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    <a href="{{ route('registro') }}" class="btn btn-secondary">Registro</a>
                @else
                    <span class="tag">{{ auth()->user()->nombre }}</span><br>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">Salir</button>
                    </form>
                @endguest
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <div id="help-modal" class="modal" hidden>
        <div class="modal-backdrop" onclick="closeHelpModal()"></div>
        <div class="modal-box">
            <h2>Información</h2>
            <div class="group-form">
                <p><strong>Instrucciónes:</strong></p>
                <p>
                    - ganará 2 puntos por acertar al equipo ganador de un partido.<br>
                    - ganará 2 puntos por acertar al marcador de un partido, o 1 punto por medio marcador.<br>
                    - ganará 2 puntos por cada pregunta institucional acertada.<br>
                    - entonces, por partido podrá obtener entre 0 y 6 puntos.<br>
                    - al final del mundial, gana quién tenga más puntos, siendo máximo 624.<br><br>
                <p><strong>Cómo jugar:</strong></p>
                <p>
                    - en la tabla de Partidos, verá un botón de "Predecir" cuando un partido esté definido, debe ingresar su equipo ganador (o empate), el marcador de goles y responder la pregunta institucional, antes de que se acabe el tiempo (antes de que suceda el partido).<br>
                    - verá en la tabla de Partidos: el marcador oficial de goles, su predicción de goles y entre paréntesis el equipo que usted predijo ganador, y una suma de, los puntos por predicción (0 a 4) + los puntos de la pregunta.<br>
                    - en la tabla Clasificación, verá a todos los jugadores con sus puntos acumulados por: predicciónes, preguntas y total.<br><br>
                </p>
                <p><strong>Administración:</strong></p>
                <p>
                    - si olvidó la contraseña o tiene dudas, diríjase con el administrador Ezequiel, oficina C200 del edificio de bienestar institucional.<br>
                    - también puede contactar al equipo de desarrollo en su oficina.
                </p>
            </div>
            <div class="actions">
                <button type="button" class="btn btn-secondary" onclick="closeHelpModal()">Ok</button>
            </div>
        </div>
    </div>

    @vite('resources/js/utils.js')
</body>
</html>
