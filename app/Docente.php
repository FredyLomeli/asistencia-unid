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

    public function scopeBusqueda($query, $busqueda){
        if($busqueda)
            return $query->where('id_banner','LIKE', "%$busqueda%")
                ->orWhere('nombre','LIKE', "%$busqueda%")
                ->orWhere('apellido_paterno','LIKE', "%$busqueda%")
                ->orWhere('apellido_materno','LIKE', "%$busqueda%")
                ->orWhere('comentario','LIKE', "%$busqueda%");
    }
}
