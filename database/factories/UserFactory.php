<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Question::class, function(Faker $faker){
    return [
        'survey_id' => 2,
        'question' => $faker->sentence(20),
        'question_type' => ($faker->boolean)? 'mcq' : 'scq',
        'alters_count' => mt_rand(2,5),
        'alter_1' => $faker->sentence(3),
        'alter_2' => $faker->sentence(3),
        'alter_3' => $faker->sentence(3),
        'alter_4' => $faker->sentence(3),
        'alter_5' => $faker->sentence(3),

    ];
});
