<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscritos extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_banner',
        'users_id',
        'empresas_id',
        'escuelas_id',
        'beca',
        'descuento',
        'lineas_negocio_id',
        'programas_id',
        'periodos_id',
        'forma_cobro',
        'inscripcion',
        'mensualidad',
        'tarjeta_digitos',
        'estado',
        'beca_banner',
        'descuento_banner',
        'beca_dev',
        'descuento_dev',
        'motivo_beca',
        'user_edit',
        'comentario',
        'adicional1',
        'adicional2',
        'adicional3',
        'adicional4',
    ];

    public $campos = [
        'id',
        'id_banner',
        'users_id',
        'empresas_id',
        'escuelas_id',
        'beca',
        'descuento',
        'lineas_negocio_id',
        'programas_id',
        'periodos_id',
        'forma_cobro',
        'inscripcion',
        'mensualidad',
        'tarjeta_digitos',
        'estado',
        'beca_banner',
        'descuento_banner',
        'beca_dev',
        'descuento_dev',
        'motivo_beca',
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
