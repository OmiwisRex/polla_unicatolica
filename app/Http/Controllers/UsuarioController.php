<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::selectRaw('usuarios.*, pts_apuestas + pts_preguntas AS total_pts')
            ->where('permiso_id', 2)
            ->orderByDesc('total_pts')
            ->orderByDesc('pts_apuestas')
            ->orderByDesc('pts_preguntas')
            ->get();

        return view('index', compact('usuarios'));
    }
}
