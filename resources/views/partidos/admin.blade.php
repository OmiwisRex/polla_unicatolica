@extends('layout')

@section('title', 'Partidos Administrador')

@section('content')
<div class="container">
    <div class="page-title">Partidos Administrador</div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="controls">
        <div>
            <label for="filtro-etapa">Filtrar por etapa:</label>
            <select id="filtro-etapa" data-route="{{ route('partidos.admin') }}">
                @foreach($etapas as $etapa)
                    <option value="{{ $etapa->id }}" {{ $selectedEtapaId == $etapa->id ? 'selected' : '' }}>{{ $etapa->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="metric-box">
            <strong>{{ $matchesToComplete }}</strong> partidos necesitan marcador por actualizar
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Etapa</th>
                <th>Equipo A</th>
                <th>Equipo B</th>
                <th>Fecha y hora</th>
                <th>Resultado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($partidos as $partido)
                <tr>
                    <td>{{ $partido->etapa?->nombre ?? 'Sin etapa' }}</td>
                    <td>
                        <div class="team-box">
                            <span class="team-flag">{{ $partido->equipoA?->bandera ?? '❓' }}</span>
                            <span class="team-name">{{ $partido->equipoA?->nombre ?? 'Por definir' }}</span>
                        </div>
                        <button type="button" class="btn btn-secondary btn-small" 
                            data-partido="{{ json_encode([
                                'id' => $partido->id,
                                'equipo_a_id' => $partido->equipo_a_id,
                                'equipo_b_id' => $partido->equipo_b_id,
                                'fecha_hora' => $partido->fecha_hora?->format('Y-m-d\TH:i'),
                                'goles_a' => $partido->goles_a,
                                'goles_b' => $partido->goles_b,
                            ]) }}" 
                            onclick="openPartidoModal(JSON.parse(this.dataset.partido))">
                            Editar
                        </button>
                    </td>
                    <td>
                        <div class="team-box">
                            <span class="team-flag">{{ $partido->equipoB?->bandera ?? '❓' }}</span>
                            <span class="team-name">{{ $partido->equipoB?->nombre ?? 'Por definir' }}</span>
                        </div>
                    </td>
                    <td>
                        @if($partido->fecha_hora)
                            {{ $partido->fecha_hora->format('d/m/Y H:i') }}
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
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="no-data">No hay partidos para esta etapa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="partido-modal" class="modal" hidden>
    <div class="modal-backdrop" onclick="closePartidoModal()"></div>
    <div class="modal-box">
        <h2>Editar partido</h2>
        <form id="partido-edit-form" method="POST" action="">
            @csrf
            @method('PATCH')

            <div class="group-form">
                <label for="equipo_a_id">Equipo A</label>
                <select id="equipo_a_id" name="equipo_a_id">
                    <option value="">Sin definir</option>
                    @foreach($equipos as $equipo)
                        <option value="{{ $equipo->id }}">{{ $equipo->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="group-form">
                <label for="equipo_b_id">Equipo B</label>
                <select id="equipo_b_id" name="equipo_b_id">
                    <option value="">Sin definir</option>
                    @foreach($equipos as $equipo)
                        <option value="{{ $equipo->id }}">{{ $equipo->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="group-form">
                <label for="fecha_hora">Fecha y hora</label>
                <input id="fecha_hora" name="fecha_hora" type="datetime-local">
            </div>

            <div class="group-form">
                <label for="goles_a">Goles Equipo A</label>
                <input id="goles_a" name="goles_a" type="number" min="0" max="30">
            </div>

            <div class="group-form">
                <label for="goles_b">Goles Equipo B</label>
                <input id="goles_b" name="goles_b" type="number" min="0" max="30">
            </div>

            <div class="actions">
                <button type="button" class="btn btn-secondary" onclick="closePartidoModal()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('filtro-etapa').addEventListener('change', function () {
        window.location.href = this.dataset.route + '?etapa=' + this.value;
    });

    function openPartidoModal(partidoJson) {
        const partido = JSON.parse(partidoJson);
        form.action = '/partidos/' + partido.id;
        document.getElementById('equipo_a_id').value = partido.equipo_a_id || '';
        document.getElementById('equipo_b_id').value = partido.equipo_b_id || '';
        document.getElementById('fecha_hora').value = partido.fecha_hora || '';
        document.getElementById('goles_a').value = partido.goles_a ?? '';
        document.getElementById('goles_b').value = partido.goles_b ?? '';
        document.getElementById('partido-modal').hidden = false;
    }

    function closePartidoModal() {
        document.getElementById('partido-modal').hidden = true;
    }
</script>
@endsection
