<?php

use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. RUTAS PÚBLICAS (Accesibles por cualquier persona, sin login)
|--------------------------------------------------------------------------
*/
// Home / Clasificación de jugadores (views/index.blade.php)
Route::get('/', [UsuarioController::class, 'index'])->name('index');

// Vista pública de partidos (views/partidos/index.blade.php)
Route::get('/partidos', [PartidoController::class, 'indexPublico'])->name('partidos.index');

/*
|--------------------------------------------------------------------------
| 2. RUTAS DE INVITADOS (Solo si NO han iniciado sesión)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Login (views/sesion/login.blade.php)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Registro (views/sesion/registro.blade.php)
    Route::get('/registro', [AuthController::class, 'showRegistro'])->name('registro');
    Route::post('/registro', [AuthController::class, 'registro']);
});


/*
|--------------------------------------------------------------------------
| 3. RUTAS PROTEGIDAS (Solo para usuarios logueados - Middleware 'auth')
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    // Cierre de sesión
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Pantalla para usuarios que no han pagado (views/sesion/pagar.blade.php)
    Route::get('/pagar', function () {
        return view('sesion.pagar');
    })->name('pagar');

    // Vista de partidos para el Jugador (views/partidos/jugador.blade.php)
    Route::get('/partidos-jugador', [PartidoController::class, 'indexJugador'])->name('partidos.jugador');
    Route::post('/partidos/{partido}/apostar', [PartidoController::class, 'apostar'])->name('partidos.apostar');

    // Vista de partidos para el Administrador (views/partidos/admin.blade.php)
    Route::get('/partidos-admin', [PartidoController::class, 'indexAdmin'])->name('partidos.admin');
    Route::patch('/partidos/{partido}', [PartidoController::class, 'update'])->name('partidos.update');

    // CRUD de Preguntas (Solo Admin deberia entrar, views/preguntas/...)
    // Excluimos 'show' porque tus vistas son index, create y edit
    Route::resource('preguntas', PreguntaController::class)->except(['show']);
});