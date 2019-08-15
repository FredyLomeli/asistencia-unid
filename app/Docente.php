<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table = 'docentes';
    public $timestamps = false;
    protected $fillable = [
        'id_banner',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'estatus',
        'comentario',
    ];
}
