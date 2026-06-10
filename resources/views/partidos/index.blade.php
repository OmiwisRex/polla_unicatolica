@extends('layout')

@section('title', 'Partidos')

@section('content')
<div class="container">
    <div class="page-title">Partidos</div>

    <div class="controls controlmax">
        <div>
            <label for="filtro-etapa">Filtrar por etapa:</label>
            <select id="filtro-etapa" data-route="{{ route('partidos.index') }}">
                @foreach($etapas as $etapa)
                    <option value="{{ $etapa->id }}" {{ $selectedEtapaId == $etapa->id ? 'selected' : '' }}>{{ $etapa->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="metric-box">
            <strong>Avance:</strong> {{ $avance }}% · {{ $partidosDefinidos }} / {{ $totalPartidos }}
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
                    <td data-label="Goles">
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

<script>
    document.getElementById('filtro-etapa').addEventListener('change', function () {
        window.location.href = this.dataset.route + '?etapa=' + this.value;
    });
</script>
@endsection
