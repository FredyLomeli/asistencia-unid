<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'users_id',
        'nombre',
        'razon_social',
        'rfc',
        'contacto',
        'celular',
        'telefono',
        'perfil_promo',
        'sector_promo',
        'alcanze_geo_promo',
        'programa_meta_promo',
        'giro_vinc',
        'covertura_vinc',
        'tipo_vinc',
        'domicilio',
        'colonia',
        'municipio',
        'codigo_postal',
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
        'nombre',
        'razon_social',
        'rfc',
        'contacto',
        'celular',
        'telefono',
        'perfil_promo',
        'sector_promo',
        'alcanze_geo_promo',
        'programa_meta_promo',
        'giro_vinc',
        'covertura_vinc',
        'tipo_vinc',
        'domicilio',
        'colonia',
        'municipio',
        'codigo_postal',
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
