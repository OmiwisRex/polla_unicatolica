@extends('layout')

@section('title', 'Partidos Administrador')

@section('content')
<div class="container">
    <div class="page-title">Partidos Administrador</div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="control controlmax">
        <div>
            <label for="filtro-etapa">Filtrar por etapa:</label>
            <select id="filtro-etapa" data-route="{{ route('partidos.admin') }}">
                <option value="pendientes_marcador" {{ $selectedEtapaId === 'pendientes_marcador' ? 'selected' : '' }}>Pendientes por marcador</option>
                @foreach($etapas as $etapa)
                    <option value="{{ $etapa->id }}" {{ $selectedEtapaId == $etapa->id ? 'selected' : '' }}>{{ $etapa->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="metric-box">
            <strong>{{ $matchesToComplete }}</strong> partidos necesitan marcador por actualizar
        </div>
    </div>

    <table class="responsive-table">
        <thead>
            <tr>
                <th>Etapa</th>
                <th>Equipo A</th>
                <th>Equipo B</th>
                <th>Fecha y hora</th>
                <th>Resultado</th>
                <th>Acciónes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($partidos as $partido)
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
                    <td data-label="Resultado">
                        @if($partido->goles_a !== null && $partido->goles_b !== null)
                            <span class="score-pill">{{ $partido->goles_a }} - {{ $partido->goles_b }}</span>
                        @elseif($partido->equipo_a_id && $partido->equipo_b_id && $partido->fecha_hora && $partido->fecha_hora->isPast())
                            <button type="button" class="btn btn-secondary btn-small"
                                data-partido="{{ json_encode([
                                    'id' => $partido->id,
                                    'equipo_a' => $partido->equipoA?->nombre,
                                    'equipo_b' => $partido->equipoB?->nombre,
                                    'goles_a' => $partido->goles_a,
                                    'goles_b' => $partido->goles_b,
                                ]) }}"
                                onclick="openResultadoModal(JSON.parse(this.dataset.partido))">
                                Marcador
                            </button>
                        @else
                            <span class="status">Pendiente</span>
                        @endif
                    </td>
                    <td data-label="Acciónes">
                        <button type="button" class="btn btn-secondary btn-small" 
                            data-partido="{{ json_encode([
                                'id' => $partido->id,
                                'equipo_a_id' => $partido->equipo_a_id,
                                'equipo_b_id' => $partido->equipo_b_id,
                                'equipo_a_nombre' => $partido->equipoA?->nombre,
                                'equipo_b_nombre' => $partido->equipoB?->nombre,
                                'etapa_nombre' => $partido->etapa?->nombre,
                                'fecha_hora' => $partido->fecha_hora?->format('Y-m-d\TH:i'),
                                'goles_a' => $partido->goles_a,
                                'goles_b' => $partido->goles_b,
                            ]) }}"
                            onclick="openPartidoModal(JSON.parse(this.dataset.partido))">
                            Editar
                        </button>
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
                <label for="goles_a"><span id="edit_goles_a_label">Goles Equipo A</span></label>
                <input id="goles_a" name="goles_a" type="number" min="0" max="30">
            </div>

            <div class="group-form">
                <label for="goles_b"><span id="edit_goles_b_label">Goles Equipo B</span></label>
                <input id="goles_b" name="goles_b" type="number" min="0" max="30">
            </div>

            <div class="actions">
                <button type="button" class="btn btn-secondary" onclick="closePartidoModal()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>

<div id="resultado-modal" class="modal" hidden>
    <div class="modal-backdrop" onclick="closeResultadoModal()"></div>
    <div class="modal-box">
        <h2>Ingresar resultado</h2>
        <form id="resultado-edit-form" method="POST" action="">
            @csrf
            @method('PATCH')

            <div class="group-form">
                <label for="resultado_goles_a">Goles Equipo A</label>
                <input id="resultado_goles_a" name="goles_a" type="number" min="0" max="30" required>
            </div>

            <div class="group-form">
                <label for="resultado_goles_b">Goles Equipo B</label>
                <input id="resultado_goles_b" name="goles_b" type="number" min="0" max="30" required>
            </div>

            <div class="actions">
                <button type="button" class="btn btn-secondary" onclick="closeResultadoModal()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar marcador</button>
            </div>
        </form>
    </div>
</div>

@vite('resources/js/partidos/index.js')
@vite('resources/js/partidos/admin.js')

@endsection
