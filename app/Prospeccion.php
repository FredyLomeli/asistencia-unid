<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospeccion extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'tipo',
        'codigo_barras',
        'codigo_rapido',
        'marca',
        'descripcion',
        'clave_sat',
        'descripcion_clave_sat',
        'unidad_medida_sat',
        'descripcion_unidad_medida_sat',
        'categoria',
        'iva',
        'iva_frontera',
        'ish',
        'ieps',
        'granel',
        'existencias',
        'stock_min',
        'stock_max',
        'descuento',
        'precio_compra',
        'precio_venta1',
        'precio_venta2',
        'precio_venta3',
        'precio_venta4',
        'precio_venta5',
        'ubicacion',
        'status',
        'comentarios',
        'adicional1',
        'adicional2',
        'adicional3',
        'adicional4',
    ];

    public $campos = [
        'id',
        'users_id',
        'tipo',
        'codigo_barras',
        'codigo_rapido',
        'marca',
        'descripcion',
        'clave_sat',
        'descripcion_clave_sat',
        'unidad_medida_sat',
        'descripcion_unidad_medida_sat',
        'categoria',
        'iva',
        'iva_frontera',
        'ish',
        'ieps',
        'granel',
        'existencias',
        'stock_min',
        'stock_max',
        'descuento',
        'precio_compra',
        'precio_venta1',
        'precio_venta2',
        'precio_venta3',
        'precio_venta4',
        'precio_venta5',
        'ubicacion',
        'status',
        'user_edit',
        'comentarios',
        'adicional1',
        'adicional2',
        'adicional3',
        'adicional4',
        'created_at',
        'updated_at',
    ];

    public $config;

    public function __construct(){
        parent::__construct();
        $this->config = new Configuration;
    }
}
