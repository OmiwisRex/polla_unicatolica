<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apuesta extends Model
{
    protected $table = 'apuestas';
    public $timestamps = false;

    protected $fillable = [
        'usuario_id', 
        'partido_id', 
        'pregunta_id', 
        'goles_a', 
        'goles_b', 
        'ganador',
        'pts_pregunta',
        'pts_apuesta'
    ];

    // Relaciones de cruce para saber qué se apostó y quién lo hizo
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function partido()
    {
        return $this->belongsTo(Partido::class, 'partido_id');
    }

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'pregunta_id');
    }
}