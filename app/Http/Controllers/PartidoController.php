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
use Illuminate\Support\Facades\DB;

class PartidoController extends Controller
{
    public function indexPublico(Request $request)
    {
        $todasLasEtapas = Etapa::orderBy('id')->get();
        $etapas = $this->agruparEtapasConFinales($todasLasEtapas);
        
        $selectedEtapaId = $this->obtenerSelectedEtapaId($request, $etapas);
        
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

    private function obtenerSelectedEtapaId(Request $request, $etapas)
    {
        $selected = $request->query('etapa');

        $validValues = $etapas->pluck('id')->map(fn($id) => (string) $id)->push('finales')->unique();

        if ($selected !== null) {
            if ($validValues->contains((string) $selected)) {
                $request->session()->put('selected_etapa_id', $selected);
                return $selected;
            }
        }

        $stored = $request->session()->get('selected_etapa_id');
        if ($stored !== null && $validValues->contains((string) $stored)) {
            return $stored;
        }

        return $etapas->first()?->id;
    }

    public function indexJugador(Request $request)
    {
        $usuario = Auth::user();
        if ($usuario->permiso_id !== 2) {
            abort(403);
        }

        $todasLasEtapas = Etapa::orderBy('id')->get();
        $etapas = $this->agruparEtapasConFinales($todasLasEtapas);
        
        $selectedEtapaId = $this->obtenerSelectedEtapaId($request, $etapas);
        
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
        
        $selectedEtapaId = $this->obtenerSelectedEtapaId($request, $etapas);
        
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

        if (array_key_exists('goles_a', $data) || array_key_exists('goles_b', $data)) {
            $this->actualizarPuntosPorPartido($partido);
        }

        return back()->with('success', 'Partido actualizado.');
    }

    public function prepararApuesta(Request $request, Partido $partido)
    {
        $usuario = Auth::user();
        if ($usuario->permiso_id !== 2) {
            abort(403);
        }

        if (! $partido->equipo_a_id || ! $partido->equipo_b_id || ! $partido->fecha_hora || $partido->fecha_hora->isPast()) {
            return response()->json(['message' => 'El partido no está disponible para apostar.'], 422);
        }

        $apuesta = $this->buscarApuestaPendiente($usuario, $partido);

        if ($apuesta && $apuesta->goles_a !== null && $apuesta->goles_b !== null) {
            return response()->json(['message' => 'Ya tienes una adivinación registrada para este partido.'], 409);
        }

        if (! $apuesta) {
            $apuesta = $this->crearApuestaPendiente($usuario, $partido);
            if (! $apuesta) {
                return response()->json(['message' => 'No hay preguntas disponibles para asignar en este momento.'], 422);
            }
        }

        $apuesta->load(['pregunta', 'partido.equipoA', 'partido.equipoB']);

        $opciones = [
            ['id' => 0, 'texto' => $apuesta->pregunta->correcta, 'correcta' => true],
            ['id' => 1, 'texto' => $apuesta->pregunta->falsa1, 'correcta' => false],
            ['id' => 2, 'texto' => $apuesta->pregunta->falsa2, 'correcta' => false],
            ['id' => 3, 'texto' => $apuesta->pregunta->falsa3, 'correcta' => false],
        ];

        return response()->json([
            'apuesta_id' => $apuesta->id,
            'equipo_a' => $partido->equipoA?->nombre ?? 'Equipo A',
            'equipo_b' => $partido->equipoB?->nombre ?? 'Equipo B',
            'pregunta' => [
                'enunciado' => $apuesta->pregunta->enunciado,
                'opciones' => $opciones,
                'correct_index' => 0,
            ],
        ]);
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
            'ganador' => 'required|in:0,1,2',
            'respuesta' => 'required|integer|in:0,1,2,3',
        ]);

        $apuesta = $this->buscarApuestaPendiente($usuario, $partido);

        if (! $apuesta || ! $apuesta->pregunta_id) {
            return back()->with('error', 'Primero debes iniciar la apuesta desde el modal para asignar una pregunta.');
        }

        if ($apuesta->goles_a !== null && $apuesta->goles_b !== null) {
            return back()->with('error', 'Ya tienes una adivinación registrada para este partido.');
        }

        $apuesta->load('pregunta');

        $ptsPregunta = (int) $request->respuesta === 0 ? 2 : 0;

        $apuesta->update([
            'goles_a' => (int) $request->goles_a,
            'goles_b' => (int) $request->goles_b,
            'ganador' => (int) $request->ganador,
            'pts_pregunta' => $ptsPregunta,
        ]);

        $this->actualizarPuntosPreguntasUsuario($usuario);

        return back()->with('success', 'Tu adivinación fue registrada.');
    }

    private function buscarApuestaPendiente(Usuario $usuario, Partido $partido)
    {
        return Apuesta::where('usuario_id', $usuario->id)
            ->where('partido_id', $partido->id)
            ->first();
    }

    private function obtenerPreguntaAleatoriaParaUsuario(Usuario $usuario)
    {
        return Pregunta::where('estado', '!=', 2)
            ->whereNotIn('id', Apuesta::where('usuario_id', $usuario->id)->pluck('pregunta_id'))
            ->inRandomOrder()
            ->first();
    }

    private function crearApuestaPendiente(Usuario $usuario, Partido $partido)
    {
        $pregunta = $this->obtenerPreguntaAleatoriaParaUsuario($usuario);

        if (! $pregunta) {
            return null;
        }

        return Apuesta::create([
            'usuario_id' => $usuario->id,
            'partido_id' => $partido->id,
            'pregunta_id' => $pregunta->id,
        ]);
    }

    private function actualizarPuntosPorPartido(Partido $partido)
    {
        if ($partido->goles_a === null || $partido->goles_b === null) {
            return;
        }

        $partidoGanador = $partido->goles_a > $partido->goles_b ? 0 : ($partido->goles_b > $partido->goles_a ? 1 : 2);

        $apuestas = Apuesta::where('partido_id', $partido->id)->get();

        foreach ($apuestas as $apuesta) {
            $ptsApuesta = 0;

            if ($apuesta->goles_a !== null && (int) $apuesta->goles_a === (int) $partido->goles_a) {
                $ptsApuesta += 1;
            }

            if ($apuesta->goles_b !== null && (int) $apuesta->goles_b === (int) $partido->goles_b) {
                $ptsApuesta += 1;
            }

            if ($apuesta->ganador !== null && (int) $apuesta->ganador === $partidoGanador) {
                $ptsApuesta += 2;
            }

            $apuesta->update(['pts_apuesta' => $ptsApuesta]);
        }

        $this->actualizarPuntajesUsuarios();
    }

    private function actualizarPuntajesUsuarios()
    {
        $usersPoints = Apuesta::selectRaw('usuario_id, COALESCE(SUM(pts_apuesta), 0) as total')
            ->groupBy('usuario_id')
            ->pluck('total', 'usuario_id');

        Usuario::chunk(100, function ($usuarios) use ($usersPoints) {
            foreach ($usuarios as $usuario) {
                $usuario->pts_apuestas = $usersPoints->get($usuario->id, 0);
                $usuario->save();
            }
        });
    }

    private function actualizarPuntosPreguntasUsuario(Usuario $usuario)
    {
        $usuario->pts_preguntas = Apuesta::where('usuario_id', $usuario->id)->sum('pts_pregunta');
        $usuario->save();
    }
}
