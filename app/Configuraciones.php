<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuraciones extends Model
{
    protected $fillable = [
        'users_id',
        'config',
        'value',
        'user_edit',
        'comentario',
        'status',
    ];

    public function scopeBusqueda($query, $busqueda){
        if($busqueda)
            return $query->where('config','LIKE', "%$busqueda%");
    }
}
