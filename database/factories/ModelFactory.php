<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(laravelVue\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(laravelVue\Categoria::class, function (Faker\Generator $faker) {

    return [
        'nombre' => $faker->name,
        'descripcion' => $faker->text,
        'condicion' => $faker->randomElement([1]),
    ];
});

$factory->define(laravelVue\Persona::class, function (Faker\Generator $faker) {

    return [
        'nombre' => $faker->name,
        'tipo' => 'Cliente',
        'tipo_doc' => $faker->lexify($string = '???'),
        'numero_doc' => $faker->randomNumber,
        'direccion' => $faker->bothify($string = '????? ###'),
        'telefono' => $faker->e164PhoneNumber,
        'email' => $faker->email,
    ];
});


