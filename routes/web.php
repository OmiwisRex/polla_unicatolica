<?php

use App\Http\Controllers\PreguntaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::resource('preguntas', PreguntaController::class)->except(['show']);
