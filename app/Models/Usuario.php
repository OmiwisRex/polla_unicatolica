<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    public $timestamps = false;

    protected $fillable = [
        'cedula', 
        'nombre', 
        'clave', 
        'pts_apuestas',
        'pts_preguntas',
        'permiso_id'
    ];

    // Protegemos la contraseña para que no se filtre en respuestas JSON automáticas
    protected $hidden = [
        'clave',
    ];

    // Relación: Un usuario tiene un rol/permiso asignado
    public function permiso()
    {
        return $this->belongsTo(Permiso::class, 'permiso_id');
    }
}