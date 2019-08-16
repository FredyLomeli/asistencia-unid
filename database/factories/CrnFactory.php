<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Crn;
use Faker\Generator as Faker;

$factory->define(Crn::class, function (Faker $faker) {
    return [
        'crn' => $faker->numberBetween(100000,999999),
        'nombre' => $faker->text(20),
        'estado' => $faker->randomElement($array = [1,0]),
    ];
});