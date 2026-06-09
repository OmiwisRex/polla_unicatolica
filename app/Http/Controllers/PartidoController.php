<?php

namespace App\Http\Controllers;

use App\Models\Apuesta;
use App\Models\Equipo;
use App\Models\Etapa;
use App\Models\Partido;
use App\Models\Pregunta;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartidoController extends Controller
{
    public function indexPublico(Request $request)
    {
        $todasLasEtapas = Etapa::orderBy('id')->get();
        $etapas = $this->agruparEtapasConFinales($todasLasEtapas);
        
        $selectedEtapaId = $request->query('etapa', $etapas->first()?->id);
        
        // Si selecciona "finales", filtrar por las etapas finales
        $etapasParaFiltro = $this->obtenerEtapasDelFiltro($selectedEtapaId, $todasLasEtapas);

        $partidos = Partido::with(['etapa', 'equipoA', 'equipoB'])
            ->when($etapasParaFiltro, fn ($query) => $query->whereIn('etapa_id', $etapasParaFiltro))
            ->orderByDesc('fecha_hora')
            ->get();

        // Avance respecto a TODOS los partidos en la BD
        $totalPartidos = Partido::count();
        $partidosDefinidos = Partido::whereNotNull('goles_a')->whereNotNull('goles_b')->count();
        $avance = $totalPartidos ? round($partidosDefinidos * 100 / $totalPartidos) : 0;

        return view('partidos.index', compact('partidos', 'etapas', 'selectedEtapaId', 'avance', 'totalPartidos', 'partidosDefinidos'));
    }

    private function agruparEtapasConFinales($etapas)
    {
        $result = collect();
        $finalesIds = [];
        $tieneFinales = false;

        foreach ($etapas as $etapa) {
            $nombre = strtolower($etapa->nombre);
            if (strpos($nombre, 'semifinal') !== false || 
                strpos($nombre, 'tercer lugar') !== false || 
                strpos($nombre, 'gran final') !== false) {
                $finalesIds[] = $etapa->id;
                $tieneFinales = true;
            } else {
                $result->push($etapa);
            }
        }

        if ($tieneFinales) {
            // Crear una etapa virtual para "finales"
            $finalesEtapa = new \stdClass();
            $finalesEtapa->id = 'finales';
            $finalesEtapa->nombre = 'Finales';
            $finalesEtapa->ids_agrupadas = $finalesIds;
            $result->push((object)$finalesEtapa);
        }

        return $result;
    }

    private function obtenerEtapasDelFiltro($selectedEtapaId, $todasLasEtapas)
    {
        if ($selectedEtapaId === 'finales') {
            return $todasLasEtapas->filter(function ($etapa) {
                $nombre = strtolower($etapa->nombre);
                return strpos($nombre, 'semifinal') !== false || 
                       strpos($nombre, 'tercer lugar') !== false || 
                       strpos($nombre, 'gran final') !== false;
            })->pluck('id')->toArray();
        }

        return [$selectedEtapaId];
    }

    public function indexJugador(Request $request)
    {
        $usuario = Auth::user();
        if ($usuario->permiso_id !== 2) {
            abort(403);
        }

        $todasLasEtapas = Etapa::orderBy('id')->get();
        $etapas = $this->agruparEtapasConFinales($todasLasEtapas);
        
        $selectedEtapaId = $request->query('etapa', $etapas->first()?->id);
        
        // Si selecciona "finales", filtrar por las etapas finales
        $etapasParaFiltro = $this->obtenerEtapasDelFiltro($selectedEtapaId, $todasLasEtapas);

        $partidos = Partido::with(['etapa', 'equipoA', 'equipoB'])
            ->when($etapasParaFiltro, fn ($query) => $query->whereIn('etapa_id', $etapasParaFiltro))
            ->orderByDesc('fecha_hora')
            ->get();

        $apuestas = Apuesta::where('usuario_id', $usuario->id)->get()->keyBy('partido_id');

        // Contar adivinaciones PENDIENTES globales
        // Partidos disponibles: equipos definidos, fecha definida, fecha aún no ha pasado
        $apuestasDisponibles = Partido::where(function ($query) {
            $query->whereNotNull('equipo_a_id')
                  ->whereNotNull('equipo_b_id')
                  ->whereNotNull('fecha_hora')
                  ->where('fecha_hora', '>', Carbon::now());
        })
        ->whereNotIn('id', Apuesta::where('usuario_id', $usuario->id)->pluck('partido_id'))
        ->count();

        return view('partidos.jugador', compact('partidos', 'etapas', 'selectedEtapaId', 'apuestas', 'apuestasDisponibles'));
    }

    public function indexAdmin(Request $request)
    {
        $usuario = Auth::user();
        if ($usuario->permiso_id !== 3) {
            abort(403);
        }

        $todasLasEtapas = Etapa::orderBy('id')->get();
        $etapas = $this->agruparEtapasConFinales($todasLasEtapas);
        
        $selectedEtapaId = $request->query('etapa', $etapas->first()?->id);
        
        // Si selecciona "finales", filtrar por las etapas finales
        $etapasParaFiltro = $this->obtenerEtapasDelFiltro($selectedEtapaId, $todasLasEtapas);

        $partidos = Partido::with(['etapa', 'equipoA', 'equipoB'])
            ->when($etapasParaFiltro, fn ($query) => $query->whereIn('etapa_id', $etapasParaFiltro))
            ->orderByDesc('fecha_hora')
            ->get();

        $equipos = Equipo::orderBy('nombre')->get();

        $matchesToComplete = Partido::whereNotNull('fecha_hora')
            ->where(function ($query) {
                $query->whereNull('goles_a')->orWhereNull('goles_b');
            })
            ->where('fecha_hora', '<=', Carbon::now())
            ->count();

        return view('partidos.admin', compact('partidos', 'etapas', 'selectedEtapaId', 'equipos', 'matchesToComplete'));
    }

    public function update(Request $request, Partido $partido)
    {
        $usuario = Auth::user();
        if ($usuario->permiso_id !== 3) {
            abort(403);
        }

        $data = $request->validate([
            'equipo_a_id' => 'nullable|exists:equipos,id',
            'equipo_b_id' => 'nullable|exists:equipos,id',
            'fecha_hora' => 'nullable|date',
            'goles_a' => 'nullable|integer|min:0|max:30',
            'goles_b' => 'nullable|integer|min:0|max:30',
        ]);

        $partido->update($data);

        return back()->with('success', 'Partido actualizado.');
    }

    public function apostar(Request $request, Partido $partido)
    {
        $usuario = Auth::user();
        if ($usuario->permiso_id !== 2) {
            abort(403);
        }

        $request->validate([
            'goles_a' => 'required|integer|min:0|max:30',
            'goles_b' => 'required|integer|min:0|max:30',
        ]);

        if (Apuesta::where('usuario_id', $usuario->id)->where('partido_id', $partido->id)->exists()) {
            return back()->with('error', 'Ya tienes una adivinación registrada para este partido.');
        }

        $pregunta = Pregunta::where('estado', '!=', 2)
            ->whereNotIn('id', Apuesta::where('usuario_id', $usuario->id)->pluck('pregunta_id'))
            ->inRandomOrder()
            ->first();

        if (! $pregunta) {
            return back()->with('error', 'No hay preguntas disponibles para asignar en este momento.');
        }

        Apuesta::create([
            'usuario_id' => $usuario->id,
            'partido_id' => $partido->id,
            'pregunta_id' => $pregunta->id,
            'goles_a' => $request->goles_a,
            'goles_b' => $request->goles_b,
        ]);

        return back()->with('success', 'Tu adivinación fue registrada y se eligió una pregunta de trivia.');
    }
}
