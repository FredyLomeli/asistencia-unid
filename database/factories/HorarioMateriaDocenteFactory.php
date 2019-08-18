<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\HorarioMateriaDocente;
use Faker\Generator as Faker;

$factory->define(HorarioMateriaDocente::class, function (Faker $faker) {
    return [
        'crn' => $faker->numberBetween(100000,999999),
        'descripcion' => $faker->text(50),
        'id_docente' => "00".$faker->numberBetween(100000,999999),
        'dia' => $faker->numberBetween(1,7),
        'fecha_vig_ini' =>  $faker->date('Y-m-d'),
        'fecha_vig_fin' =>  $faker->date('Y-m-d'),
        'hora_ini' => date('H:i:s', rand(1,54000)),
        'hora_fin' => date('H:i:s', rand(1,54000)),
        'grupo' => $faker->text(10),
        'calendario' => $faker->text(50),
        'comentario' => $faker->text(300),
    ];
});
