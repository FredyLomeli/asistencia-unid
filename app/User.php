<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_banner',
        'name',
        'apellidos',
        'email',
        'email_verified_at',
        'password',
        'curp',
        'rfc',
        'domicilio',
        'no_nomina',
        'cargos_id',
        'estado',
        'comentario',
        'adicional1',
        'adicional2',
        'adicional3',
        'adicional4',
        'nuevo_avance_promo',
        'consulta_avance_promo',
        'consulta_avance_promo_general',
        'cancelar_avace_promo',
        'nuevo_inscrito_promo',
        'consulta_inscrito_promo',
        'edicion_inscrito_promo',
        'consulta_inscrito_promo_general',
        'consulta_prospeccion_promo',
        'consulta_prospeccion_promo_general',
        'nuevo_periodo_promo',
        'consulta_periodo_promo',
        'editar_periodo_promo',
        'cancelar_periodo_promo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
