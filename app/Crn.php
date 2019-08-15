<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crn extends Model
{
    protected $table = 'crn';
    public $timestamps = false;
    protected $fillable = [
        'crn',
        'nombre',
        'estado',
    ];

    public function scopeBusqueda($query, $busqueda){
        if($busqueda)
            return $query->where('crn','LIKE', "%$busqueda%")
                ->orWhere('nombre','LIKE', "%$busqueda%");
    }
}
