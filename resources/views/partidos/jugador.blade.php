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

    <div class="controls">
        <div>
            <label for="filtro-etapa">Filtrar por etapa:</label>
            <select id="filtro-etapa" data-route="{{ route('partidos.jugador') }}">
                @foreach($etapas as $etapa)
                    <option value="{{ $etapa->id }}" {{ $selectedEtapaId == $etapa->id ? 'selected' : '' }}>{{ $etapa->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="metric-box">
            <strong>Apuestas:</strong> {{ $apuestas->count() }} registradas
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
                        @if($apuesta)
                            <span class="score-pill">{{ $apuesta->goles_a }} - {{ $apuesta->goles_b }}</span>
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
                    <td colspan="6" class="no-data">No hay partidos para esta etapa.</td>
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

            <div class="group-form">
                <label for="goles_a">Goles Equipo A</label>
                <input id="goles_a" name="goles_a" type="number" min="0" max="30" required>
            </div>

            <div class="group-form">
                <label for="goles_b">Goles Equipo B</label>
                <input id="goles_b" name="goles_b" type="number" min="0" max="30" required>
            </div>

            <div class="actions">
                <button type="button" class="btn btn-secondary" onclick="closeApuestaModal()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Enviar adivinación</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('filtro-etapa').addEventListener('change', function () {
        window.location.href = this.dataset.route + '?etapa=' + this.value;
    });

    function openApuestaModal(partidoId) {
        const form = document.getElementById('apuesta-form');
        form.action = '/partidos/' + partidoId + '/apostar';
        document.getElementById('goles_a').value = '';
        document.getElementById('goles_b').value = '';
        document.getElementById('apuesta-modal').hidden = false;
    }

    function closeApuestaModal() {
        document.getElementById('apuesta-modal').hidden = true;
    }
</script>
@endsection
