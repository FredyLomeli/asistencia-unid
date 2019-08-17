<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Configuracion;
use Faker\Generator as Faker;

$factory->define(Configuracion::class, function (Faker $faker) {
    return [
        'nombre' => $faker->userName,
        'datos' => $faker->text(100),
        'tipo' => $faker->biasedNumberBetween('1','11'),
    ];
});
