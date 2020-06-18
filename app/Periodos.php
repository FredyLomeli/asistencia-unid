<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodos extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'users_id',
        'descripcion',
        'periodo',
        'meta_general',
        'fecha_inicio',
        'fecha_fin',
        'costo_inscripcion_lic',
        'costo_mensualidad_lic',
        'costo_inscripcion_eje',
        'costo_mensualidad_eje',
        'costo_mensualidad_mae',
        'costo_mensualidad_mae_edu',
        'estado',
        'user_edit',
        'comentario',
        'adicional1',
        'adicional2',
        'adicional3',
        'adicional4',
    ];

    public $campos = [
        'id',
        'users_id',
        'descripcion',
        'periodo',
        'meta_general',
        'fecha_inicio',
        'fecha_fin',
        'costo_inscripcion_lic',
        'costo_mensualidad_lic',
        'costo_inscripcion_eje',
        'costo_mensualidad_eje',
        'costo_mensualidad_mae',
        'costo_mensualidad_mae_edu',
        'estado',
        'user_edit',
        'comentario',
        'adicional1',
        'adicional2',
        'adicional3',
        'adicional4',
    ];

    public $config;

    public function __construct(){
        parent::__construct();
        $this->config = new Configuration;
    }
}
