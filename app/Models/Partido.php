<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    protected $table = 'partidos';
    public $timestamps = false;

    // Solo permitimos modificar estos tres datos desde el panel de administración
    protected $fillable = [
        'equipo_a_id',
        'equipo_b_id',
        'fecha_hora', 
        'goles_a', 
        'goles_b'
    ];

    // Mutador para manejar la fecha cómodamente con Carbon
    protected $casts = [
        'fecha_hora' => 'datetime',
    ];

    // Relaciones indispensables para armar el fixture visual
    public function etapa()
    {
        return $this->belongsTo(Etapa::class, 'etapa_id');
    }

    public function equipoA()
    {
        return $this->belongsTo(Equipo::class, 'equipo_a_id');
    }

    public function equipoB()
    {
        return $this->belongsTo(Equipo::class, 'equipo_b_id');
    }
}