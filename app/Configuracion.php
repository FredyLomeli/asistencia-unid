<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuracion';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'datos',
        'tipo',
    ];

    public function scopeBusqueda($query, $busqueda){
        if($busqueda)
            return $query->where('nombre','LIKE', "%$busqueda%");
    }
}
