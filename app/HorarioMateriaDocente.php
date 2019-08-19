<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorarioMateriaDocente extends Model
{
    protected $table = 'horario_materia_docente';
    public $timestamps = false;
    protected $fillable = [
        'crn',
        'descripcion',
        'id_docente',
        'dia',
        'fecha_vig_ini',
        'fecha_vig_fin',
        'hora_ini',
        'hora_fin',
        'grupo',
        'calendario',
        'comentario',
    ];

    public function scopeBusqueda($query, $busqueda){
        if($busqueda)
            return $query->where('crn','LIKE', "%$busqueda%")
                ->orWhere('descripcion','LIKE', "%$busqueda%")
                ->orWhere('id_docente','LIKE', "%$busqueda%");
    }
}
