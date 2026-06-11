<?php

namespace App\Http\Controllers;

use App\Models\Apuesta;
use App\Models\Pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreguntaController extends Controller
{
    public function index()
    {
        $preguntas = Pregunta::where('estado', '!=', 2)->orderByDesc('id')->get();
        return view('preguntas.index', compact('preguntas'));
    }

    public function create()
    {
        return view('preguntas.create');
    }

    public function store(Request $request)
    {
        abort_if(Auth::user()->permiso_id !== 3, 403);

        $request->validate([
            'enunciado' => 'required|string|max:1024',
            'correcta'  => 'required|string|max:1024',
            'falsa1'    => 'required|string|max:1024',
            'falsa2'    => 'required|string|max:1024',
            'falsa3'    => 'required|string|max:1024',
        ]);

        Pregunta::create($request->all());

        return redirect()->route('preguntas.index')->with('success', 'Pregunta creada con éxito.');
    }

    public function edit($id)
    {
        $pregunta = Pregunta::findOrFail($id);
        return view('preguntas.edit', compact('pregunta'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Auth::user()->permiso_id !== 3, 403);

        $request->validate([
            'enunciado' => 'required|string|max:1024',
            'correcta'  => 'required|string|max:1024',
            'falsa1'    => 'required|string|max:1024',
            'falsa2'    => 'required|string|max:1024',
            'falsa3'    => 'required|string|max:1024',
        ]);

        $pregunta = Pregunta::findOrFail($id);
        $pregunta->update($request->all());

        return redirect()->route('preguntas.index')->with('success', 'Pregunta actualizada.');
    }

    public function destroy($id)
    {
        abort_if(Auth::user()->permiso_id !== 3, 403);

        $pregunta = Pregunta::findOrFail($id);

        if (Apuesta::where('pregunta_id', $pregunta->id)->exists()) {
            return redirect()->route('preguntas.index')
                ->with('error', 'No se puede eliminar la pregunta porque ya está siendo usada en predicciónes.');
        }

        $pregunta->update([
            'estado' => 2
        ]);

        return redirect()->route('preguntas.index')->with('success', 'Pregunta eliminada.');
    }
}