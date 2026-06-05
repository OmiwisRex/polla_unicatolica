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

        // 2. Intentamos henticar de forma manual con Auth::attempt()
        // Mapeamos 'password' internamente a tu columna 'clave' gracias al modelo
        if (Auth::attempt(['cedula' => $credentials['cedula'], 'password' => $credentials['clave']])) {
            
            $request->session()->regenerate(); // Seguridad contra fijación de sesiones
            $usuarioLogueado = Auth::user();

            // Redirección Contextual basada en las reglas de tu README:
            if ($usuarioLogueado->permiso_id == 3) {
                // Administrador -> Va a partidos admin
                return redirect()->route('partidos.admin');
            } elseif ($usuarioLogueado->permiso_id == 2) {
                // Jugador con acceso -> Va a partidos jugador
                return redirect()->route('partidos.jugador');
            } else {
                // Permiso Ninguno (1) -> No ha pagado, va a la vista de cobrar
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
        $request->validate([
            'cedula' => 'required|string|max:32|unique:usuarios,cedula',
            'nombre' => 'required|string|max:32',
            'clave' => 'required|string|min:6|confirmed',
        ]);

        // 2. Creamos el usuario en la base de datos
        // Por defecto: pts_apuestas y pts_preguntas inician en 0, permiso_id es 1 (Ninguno)
        $usuario = Usuario::create([
            'cedula' => $request->cedula,
            'nombre' => $request->nombre,
            'clave' => Hash::make($request->clave),
        ]);

        // 3. Lo logueamos automáticamente inmediatamente después del registro
        Auth::login($usuario);

        // 4. Según requerimiento: Al registrarse va directo a la pantalla "pagar"
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