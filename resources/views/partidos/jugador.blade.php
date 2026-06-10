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

    <div class="controls controlmax">
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

    <table>
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
                    $puedeApostar = $partido->equipo_a_id && $partido->equipo_b_id && $partido->fecha_hora && $partido->fecha_hora->isFuture() && !$apuesta;
                @endphp
                <tr>
                    <td>{{ $partido->etapa?->nombre ?? 'Sin etapa' }}</td>
                    <td>
                        <div class="team-box">
                            @if($partido->equipoA?->bandera)
                                <span class="team-flag fi fi-{{ $partido->equipoA->bandera }}"></span>
                            @else
                                <span class="team-flag">❓</span>
                            @endif
                            <span class="team-name">{{ $partido->equipoA?->nombre ?? 'Por definir' }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="team-box">
                            @if($partido->equipoB?->bandera)
                                <span class="team-flag fi fi-{{ $partido->equipoB->bandera }}"></span>
                            @else
                                <span class="team-flag">❓</span>
                            @endif
                            <span class="team-name">{{ $partido->equipoB?->nombre ?? 'Por definir' }}</span>
                        </div>
                    </td>
                    <td>
                        @if($partido->fecha_hora)
                            <div>{{ $partido->fecha_hora->format('d/m/Y') }}</div>
                            <div class="sub-text">{{ $partido->fecha_hora->format('h:i A') }}</div>
                        @else
                            <span class="status">Por definir</span>
                        @endif
                    </td>
                    <td>
                        @if($partido->goles_a !== null && $partido->goles_b !== null)
                            <span class="score-pill">{{ $partido->goles_a }} - {{ $partido->goles_b }}</span>
                        @else
                            <span class="status">Pendiente</span>
                        @endif
                    </td>
                    <td>
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
                    <td>
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

<script>
    document.getElementById('filtro-etapa').addEventListener('change', function () {
        window.location.href = this.dataset.route + '?etapa=' + this.value;
    });

    async function prepareApuestaModal(partidoId) {
        const url = '/partidos/' + partidoId + '/preparar-apuesta';
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({}),
            });

            const data = await response.json();
            if (!response.ok) {
                alert(data.message || 'No se pudo preparar la apuesta.');
                return;
            }

            const form = document.getElementById('apuesta-form');
            form.action = '/partidos/' + partidoId + '/apostar';
            document.getElementById('apuesta_id').value = data.apuesta_id ?? '';
            document.getElementById('goles_a').value = '';
            document.getElementById('goles_b').value = '';
            document.getElementById('ganador_a_option').textContent = data.equipo_a;
            document.getElementById('ganador_b_option').textContent = data.equipo_b;
            document.getElementById('goles_a_label').textContent = 'Goles ' + data.equipo_a;
            document.getElementById('goles_b_label').textContent = 'Goles ' + data.equipo_b;

            const preguntaBox = document.getElementById('pregunta-box');
            const preguntaEnunciado = document.getElementById('pregunta-enunciado');
            const preguntaOpciones = document.getElementById('pregunta-opciones');

            preguntaBox.hidden = false;
            preguntaEnunciado.textContent = data.pregunta.enunciado;
            preguntaOpciones.innerHTML = '';

            const respuestas = data.pregunta.opciones.slice();

            shuffleArray(respuestas);

            respuestas.forEach((respuesta, index) => {
                const optionId = 'respuesta_' + index;
                const wrapper = document.createElement('div');
                wrapper.className = 'radio-option';
                wrapper.innerHTML = `
                    <label for="${optionId}">
                        <input id="${optionId}" type="radio" name="respuesta" value="${respuesta.id}" required>
                        ${escapeHtml(respuesta.texto)}
                    </label>
                `;
                preguntaOpciones.appendChild(wrapper);
            });

            document.getElementById('apuesta-modal').hidden = false;
        } catch (error) {
            console.error(error);
            alert('Hubo un error al preparar la apuesta.');
        }
    }

    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    function escapeHtml(text) {
        return text
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function closeApuestaModal() {
        document.getElementById('apuesta-modal').hidden = true;
    }
</script>
@endsection
