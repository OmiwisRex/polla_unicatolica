@extends('layout')

@section('title', 'Partidos Jugador')

@section('content')
<div class="container">
    <div class="page-title">Partidos Jugador</div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-danger">{{ session('error') }}</div>
    @endif

    <div class="control controlmax">
        <div>
            <label for="filtro-etapa">Filtrar por etapa:</label>
            <select id="filtro-etapa" data-route="{{ route('partidos.jugador') }}">
                @foreach($etapas as $etapa)
                    <option value="{{ $etapa->id }}" {{ $selectedEtapaId == $etapa->id ? 'selected' : '' }}>{{ $etapa->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="metric-box">
            <strong>Predicciónes:</strong> {{ $apuestasDisponibles }} pendientes
        </div>
    </div>

    <table class="responsive-table">
        <thead>
            <tr>
                <th>Etapa</th>
                <th>Equipo A</th>
                <th>Equipo B</th>
                <th>Fecha y hora</th>
                <th>Goles</th>
                <th>Predicciónes</th>
                <th>Puntos</th>
            </tr>
        </thead>
        <tbody>
            @forelse($partidos as $partido)
                @php
                    $apuesta = $apuestas[$partido->id] ?? null;
                    $puedeApostar = $partido->equipo_a_id && $partido->equipo_b_id && $partido->fecha_hora && $partido->fecha_hora->isFuture() && !$apuesta && $partido->goles_a === null && $partido->goles_b === null;
                @endphp
                <tr>
                    <td data-label="Etapa">{{ $partido->etapa?->nombre ?? 'Sin etapa' }}</td>
                    <td data-label="Equipo A">
                        <div class="team-box">
                            @if($partido->equipoA?->bandera)
                                <span class="team-flag fi fi-{{ $partido->equipoA->bandera }}"></span>
                            @else
                                <span class="team-flag">❓</span>
                            @endif
                            <span class="team-name">{{ $partido->equipoA?->nombre ?? 'Por definir' }}</span>
                        </div>
                    </td>
                    <td data-label="Equipo B">
                        <div class="team-box">
                            @if($partido->equipoB?->bandera)
                                <span class="team-flag fi fi-{{ $partido->equipoB->bandera }}"></span>
                            @else
                                <span class="team-flag">❓</span>
                            @endif
                            <span class="team-name">{{ $partido->equipoB?->nombre ?? 'Por definir' }}</span>
                        </div>
                    </td>
                    <td data-label="Fecha y hora">
                        @if($partido->fecha_hora)
                            <div>{{ $partido->fecha_hora->format('d/m/Y') }}</div>
                            <div class="sub-text">{{ $partido->fecha_hora->format('h:i A') }}</div>
                        @else
                            <span class="status">Por definir</span>
                        @endif
                    </td>
                    <td data-label="Goles">
                        @if($partido->goles_a !== null && $partido->goles_b !== null)
                            <span class="score-pill">{{ $partido->goles_a }} - {{ $partido->goles_b }}</span>
                        @else
                            <span class="status">Pendiente</span>
                        @endif
                    </td>
                    <td data-label="Predicciónes">
                        @if($apuesta && $apuesta->goles_a !== null && $apuesta->goles_b !== null)
                            @php
                                $ganadorApuesta = '';
                                if ($apuesta->ganador === 0) {
                                    $ganadorApuesta = ' ( A )';
                                } elseif ($apuesta->ganador === 1) {
                                    $ganadorApuesta = ' ( B )';
                                } elseif ($apuesta->ganador === 2) {
                                    $ganadorApuesta = ' (emp)';
                                }
                            @endphp
                            <span class="score-pill">{{ $apuesta->goles_a }} - {{ $apuesta->goles_b }}{{ $ganadorApuesta }}</span>
                        @elseif($apuesta)
                            <button type="button" class="btn btn-secondary btn-small" onclick="prepareApuestaModal('{{ $partido->id }}')">
                                Predecir
                            </button>
                        @elseif($puedeApostar)
                            <button type="button" class="btn btn-secondary btn-small" onclick="prepareApuestaModal('{{ $partido->id }}')">
                                Predecir
                            </button>
                        @elseif($partido->fecha_hora && $partido->fecha_hora->isPast())
                            <span class="status">Vencida</span>
                        @else
                            <span class="status">Esperando</span>
                        @endif
                    </td>
                    <td data-label="Puntos">
                        @if($apuesta)
                            @php
                                $apuestaPts = $apuesta->pts_apuesta ?? 0;
                                $preguntaPts = $apuesta->pts_pregunta ?? 0;
                            @endphp
                            <span>{{ $apuestaPts }} + {{ $preguntaPts }} = {{ $apuestaPts + $preguntaPts }}</span>
                        @else
                            <span>0</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="no-data">No hay partidos para esta etapa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="apuesta-modal" class="modal" hidden>
    <div class="modal-backdrop" onclick="closeApuestaModal()"></div>
    <div class="modal-box">
        <h2>Registrar predicción</h2>
        <form id="apuesta-form" method="POST" action="">
            @csrf

            <input id="apuesta_id" name="apuesta_id" type="hidden">

            <div class="group-form">
                <label for="ganador">Resultado</label>
                <select id="ganador" name="ganador" required>
                    <option value="0" id="ganador_a_option">Equipo A</option>
                    <option value="1" id="ganador_b_option">Equipo B</option>
                    <option value="2" selected>Empate</option>
                </select>
            </div>

            <div class="group-form">
                <label for="goles_a"><span id="goles_a_label">Goles Equipo A</span></label>
                <input id="goles_a" name="goles_a" type="number" min="0" max="30" required>
            </div>

            <div class="group-form">
                <label for="goles_b"><span id="goles_b_label">Goles Equipo B</span></label>
                <input id="goles_b" name="goles_b" type="number" min="0" max="30" required>
            </div>

            <div id="pregunta-box" class="group-form" hidden>
                <label>Pregunta sobre la Unicatólica</label>
                <div id="pregunta-enunciado" class="question-text"></div>
                <div id="pregunta-opciones" class="options-list"></div>
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Enviar predicción</button>
            </div>
        </form>
    </div>
</div>

@vite('resources/js/partidos/index.js')
@vite('resources/js/partidos/jugador.js')

@endsection
