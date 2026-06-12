<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function search(Request $request)
    {
        abort_if(Auth::user()->permiso_id !== 3, 403);

        $cedula = $request->query('cedula', $request->input('cedula'));
        $usuario = null;

        if (!empty($cedula)) {
            $request->validate([
                'cedula' => 'required|string|max:32',
            ]);

            $usuario = Usuario::with('permiso')
                ->where('cedula', $cedula)
                ->first();
        }

        $jugadoresActivos = Usuario::where('permiso_id', 2)
            ->orderBy('nombre')
            ->get();

        $jugadoresInactivos = Usuario::where('permiso_id', 1)
            ->orderBy('nombre')
            ->get();

        return view('usuarios.search', compact('usuario', 'cedula', 'jugadoresActivos', 'jugadoresInactivos'));
    }

    public function edit(Usuario $usuario)
    {
        abort_if(Auth::user()->permiso_id !== 3, 403);

        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        abort_if(Auth::user()->permiso_id !== 3, 403);

        $rules = [
            'nombre' => 'required|string|max:255',
            'restablecer_clave' => 'required|in:si,no',
        ];

        if ($usuario->permiso_id !== 3) {
            $rules['permiso_id'] = 'required|in:1,2';
        }

        $data = $request->validate($rules, [
            'restablecer_clave.in' => 'La opción de restablecer la contraseña no es válida.',
        ]);

        $usuario->nombre = $data['nombre'];

        if ($usuario->permiso_id !== 3) {
            $usuario->permiso_id = $data['permiso_id'];
        }

        if ($data['restablecer_clave'] === 'si') {
            $defaultPassword = env('DEFAULT_PASSWORD', 'password');
            $usuario->clave = Hash::make($defaultPassword);
        }

        $usuario->save();

        return redirect()->route('usuarios.search', ['cedula' => $usuario->cedula])
            ->with('success', 'Usuario actualizado correctamente.');
    }
}
