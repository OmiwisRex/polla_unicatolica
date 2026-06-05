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
        $etapas = Etapa::orderBy('id')->get();
        $selectedEtapaId = $request->query('etapa', $etapas->first()?->id);

        $partidos = Partido::with(['etapa', 'equipoA', 'equipoB'])
            ->when($selectedEtapaId, fn ($query) => $query->where('etapa_id', $selectedEtapaId))
            ->orderByDesc('fecha_hora')
            ->get();

        $total = $partidos->count();
        $definidos = $partidos->filter(fn ($partido) => $partido->goles_a !== null && $partido->goles_b !== null)->count();
        $avance = $total ? round($definidos * 100 / $total) : 0;

        return view('partidos.index', compact('partidos', 'etapas', 'selectedEtapaId', 'avance', 'total', 'definidos'));
    }

    public function indexJugador(Request $request)
    {
        $usuario = Auth::user();
        if ($usuario->permiso_id !== 2) {
            abort(403);
        }

        $etapas = Etapa::orderBy('id')->get();
        $selectedEtapaId = $request->query('etapa', $etapas->first()?->id);

        $partidos = Partido::with(['etapa', 'equipoA', 'equipoB'])
            ->when($selectedEtapaId, fn ($query) => $query->where('etapa_id', $selectedEtapaId))
            ->orderByDesc('fecha_hora')
            ->get();

        $apuestas = Apuesta::where('usuario_id', $usuario->id)->get()->keyBy('partido_id');

        return view('partidos.jugador', compact('partidos', 'etapas', 'selectedEtapaId', 'apuestas'));
    }

    public function indexAdmin(Request $request)
    {
        $usuario = Auth::user();
        if ($usuario->permiso_id !== 3) {
            abort(403);
        }

        $etapas = Etapa::orderBy('id')->get();
        $selectedEtapaId = $request->query('etapa', $etapas->first()?->id);

        $partidos = Partido::with(['etapa', 'equipoA', 'equipoB'])
            ->when($selectedEtapaId, fn ($query) => $query->where('etapa_id', $selectedEtapaId))
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
            return back()->with('error', 'Ya tienes una apuesta registrada para este partido.');
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

        return back()->with('success', 'Tu apuesta fue registrada y se eligió una pregunta de trivia.');
    }
}
