<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table = 'preguntas';
    public $timestamps = false;

    // Habilitamos la asignación masiva para los formularios del CRUD
    protected $fillable = [
        'enunciado', 
        'correcta', 
        'falsa1', 
        'falsa2', 
        'falsa3'
    ];
}