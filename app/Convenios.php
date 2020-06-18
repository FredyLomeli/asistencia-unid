<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convenios extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'users_id',
        'empresas_id',
        'escuelas_id',
        'conv_promo',
        'descripcion_conv_promo',
        'conv_servicio',
        'descripcion_conv_servicio',
        'conv_estadia',
        'descripcion_conv_estadia',
        'fecha_conv',
        'vigencia_conv',
        'nombre_representante',
        'cargo_representante',
        'correo_representante',
        'telefono_representante',
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
        'empresas_id',
        'escuelas_id',
        'conv_promo',
        'descripcion_conv_promo',
        'conv_servicio',
        'descripcion_conv_servicio',
        'conv_estadia',
        'descripcion_conv_estadia',
        'fecha_conv',
        'vigencia_conv',
        'nombre_representante',
        'cargo_representante',
        'correo_representante',
        'telefono_representante',
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
