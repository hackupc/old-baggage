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

$factory->define(App\User::class, function ($faker) {
    return [
        'username' => $faker->username
    ];
});

$factory->define(App\Position::class, function ($faker) {
    return [
        'row' => $faker->randomElement($array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J')),
        'col' => $faker->numberBetween($min=0, $max=13),
        'id' => $faker->creditCardNumber,
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true)
    ];
});
