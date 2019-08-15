<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Docente;
use Faker\Generator as Faker;

$factory->define(Docente::class, function (Faker $faker) {
    return [
        'id_banner' => "00".$faker->numberBetween(100000,999999),
        'nombre' => $faker->firstName,
        'apellido_paterno' => $faker->lastName,
        'apellido_materno' => $faker->lastName,
        'estatus' => $faker->randomElement($array = [1,0]),
        'comentario' => $faker->text(300) ,
    ];
    // \App\User::create([
    //     'username'  =-->  $faker->userName,
    //     'firstname' =>  $faker->firstName,
    //     'lastname'  =>  $faker->lastName,
    //     'email'     =>  $faker->email,
    //     'birthdate' =>  $faker->date('Y-m-d'),
    //     'password'  =>  bcrypt('password'),
    //     'location'  =>  $faker->city,
    //     'gender'    =>  $faker->randomElement($array = ['male','female']),
    //     'active'    =>  $faker->numberBetween(0,1),
    //     'country_id'=>  $faker->biasedNumberBetween('254','506'),
    //     'created_at'=>  $faker->dateTime,
    // ]);
});
