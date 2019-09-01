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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(App\Author::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'email' => $faker->email,
        'github' => $faker->email,
        'twitter' => $faker->email,
        'location' => $faker->address
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    return [
        'subject'           => $faker->sentence(6),
        'secondary_title'   => $faker->sentence(3),
        'body'              => $faker->text,
        'image'             => $faker->image,
        'author_id'         => factory(App\Author::class)->create()->id
    ];
});
