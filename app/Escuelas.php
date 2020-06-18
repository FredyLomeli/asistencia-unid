<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escuelas extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'users_id',
        'nombre',
        'clave_cct',
        'tipificacion_promo',
        'contacto',
        'celular',
        'telefono',
        'tipo_escuela',
        'secundaria',
        'prepa',
        'universidad',
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
        'clave_cct',
        'tipificacion_promo',
        'contacto',
        'celular',
        'telefono',
        'tipo_escuela',
        'secundaria',
        'prepa',
        'universidad',
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
