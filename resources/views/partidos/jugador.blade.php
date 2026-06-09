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
            <strong>Adivinaciónes:</strong> {{ $apuestasDisponibles }} pendientes
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
                <th>Adivinación</th>
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
                            <span class="team-flag">{{ $partido->equipoA?->bandera ?? '❓' }}</span>
                            <span class="team-name">{{ $partido->equipoA?->nombre ?? 'Por definir' }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="team-box">
                            <span class="team-flag">{{ $partido->equipoB?->bandera ?? '❓' }}</span>
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
                            <span class="score-pill">{{ $apuesta->goles_a }} - {{ $apuesta->goles_b }}</span>
                        @elseif($apuesta)
                            <button type="button" class="btn btn-secondary btn-small" onclick="prepareApuestaModal({{ $partido->id }})">
                                Adivinar
                            </button>
                        @elseif($puedeApostar)
                            <button type="button" class="btn btn-secondary btn-small" onclick="prepareApuestaModal({{ $partido->id }})">
                                Adivinar
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
        <h2>Registrar adivinación</h2>
        <form id="apuesta-form" method="POST" action="">
            @csrf

            <input id="apuesta_id" name="apuesta_id" type="hidden">

            <div class="group-form">
                <label for="goles_a">Goles Equipo A</label>
                <input id="goles_a" name="goles_a" type="number" min="0" max="30" required>
            </div>

            <div class="group-form">
                <label for="goles_b">Goles Equipo B</label>
                <input id="goles_b" name="goles_b" type="number" min="0" max="30" required>
            </div>

            <div id="pregunta-box" class="group-form" hidden>
                <label>Pregunta sobre la Unicatólica</label>
                <div id="pregunta-enunciado" class="question-text"></div>
                <div id="pregunta-opciones" class="options-list"></div>
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Enviar adivinación</button>
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

            const preguntaBox = document.getElementById('pregunta-box');
            const preguntaEnunciado = document.getElementById('pregunta-enunciado');
            const preguntaOpciones = document.getElementById('pregunta-opciones');

            preguntaBox.hidden = false;
            preguntaEnunciado.textContent = data.pregunta.enunciado;
            preguntaOpciones.innerHTML = '';

            const respuestas = [
                { value: data.pregunta.correcta, isCorrect: true },
                { value: data.pregunta.falsa1, isCorrect: false },
                { value: data.pregunta.falsa2, isCorrect: false },
                { value: data.pregunta.falsa3, isCorrect: false },
            ];

            shuffleArray(respuestas);

            respuestas.forEach((respuesta, index) => {
                const optionId = 'respuesta_' + index;
                const wrapper = document.createElement('div');
                wrapper.className = 'radio-option';
                wrapper.innerHTML = `
                    <label for="${optionId}">
                        <input id="${optionId}" type="radio" name="respuesta" value="${escapeHtml(respuesta.value)}" required>
                        ${escapeHtml(respuesta.value)}
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
