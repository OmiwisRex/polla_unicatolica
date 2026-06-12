<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Muestra la vista del formulario de Login
    public function showLogin()
    {
        return view('sesion.login');
    }

    // Procesa el inicio de sesión
    public function login(Request $request)
    {
        // 1. Validamos los datos de entrada
        $credentials = $request->validate([
            'cedula' => 'required|string',
            'clave'  => 'required|string',
        ]);

        $defaultPassword = env('DEFAULT_PASSWORD', 'password');

        // 2. Intentamos autenticar con la clave ingresada
        if (Auth::attempt(['cedula' => $credentials['cedula'], 'password' => $credentials['clave']])) {
            $request->session()->regenerate(); // Seguridad contra fijación de sesiones
            /** @var \App\Models\User $usuarioLogueado */
            $usuarioLogueado = Auth::user();

            if (Hash::check($defaultPassword, $usuarioLogueado->clave)) {
                $usuarioLogueado->clave = Hash::make($credentials['clave']);
                $usuarioLogueado->save();
            }

            if ($usuarioLogueado->permiso_id == 3) {
                return redirect()->route('partidos.admin');
            } elseif ($usuarioLogueado->permiso_id == 2) {
                return redirect()->route('partidos.jugador');
            } else {
                return redirect()->route('pagar');
            }
        }

        // 3. Si la contraseña almacenada es la contraseña por defecto, permitimos el ingreso y actualizamos la clave
        $usuario = Usuario::where('cedula', $credentials['cedula'])->first();

        if ($usuario && Hash::check($defaultPassword, $usuario->clave)) {
            Auth::login($usuario);
            $usuario->clave = Hash::make($credentials['clave']);
            $usuario->save();
            $request->session()->regenerate();

            if ($usuario->permiso_id == 3) {
                return redirect()->route('partidos.admin');
            } elseif ($usuario->permiso_id == 2) {
                return redirect()->route('partidos.jugador');
            } else {
                return redirect()->route('pagar');
            }
        }

        // Si falla la autenticación, regresa con un error
        return back()->withErrors([
            'cedula' => 'La cédula o la contraseña no coinciden con nuestros registros.',
        ])->onlyInput('cedula');
    }

    // Muestra la vista del formulario de Registro
    public function showRegistro()
    {
        return view('sesion.registro');
    }

    // Procesa la creación de un nuevo usuario
    public function registro(Request $request)
    {
        // 1. Validamos los requerimientos técnicos del formulario
        // Validar nombre solo con letras, acentos españoles, números y espacios
        $request->validate([
            'cedula' => 'required|string|max:32|unique:usuarios,cedula',
            'nombre' => [
                'required',
                'string',
                'max:32',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            ],
            'clave' => 'required|string|min:6|confirmed',
        ], [
            'cedula.unique' => 'La cédula ya se encuentra registrada.',
            'nombre.regex' => 'El nombre solo puede contener letras, acentos españoles y espacios.',
        ]);

        // 2. Determinamos si es el primer usuario registrado
        $esPrimerUsuario = Usuario::count() === 0;

        // 3. Creamos el usuario en la base de datos
        $usuario = Usuario::create([
            'cedula' => $request->cedula,
            'nombre' => $request->nombre,
            'clave' => Hash::make($request->clave),
            'permiso_id' => $esPrimerUsuario ? 3 : 1,
        ]);

        // 4. Lo logueamos automáticamente inmediatamente después del registro
        Auth::login($usuario);

        // 5. Si es el primer usuario y quedó como administrador, lo enviamos a administración
        if ($usuario->permiso_id === 3) {
            return redirect()->route('partidos.admin')->with('success', 'Registro exitoso. Ya tienes permisos de administrador.');
        }

        return redirect()->route('pagar')->with('success', 'Registro exitoso.');
    }

    // Cierra la sesión activa
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Al hacer logout regresa a la tabla pública de partidos
        return redirect()->route('index');
    }
}