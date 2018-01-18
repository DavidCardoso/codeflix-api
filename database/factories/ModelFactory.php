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
$factory->define(\CodeFlix\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10)
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->state(\CodeFlix\Models\User::class, 'admin', function (Faker\Generator $faker) {
    return [
        'role' => \CodeFlix\Models\User::ROLE_ADMIN,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\CodeFlix\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\CodeFlix\Models\Serie::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(3),
        'description' => $faker->sentence(5),
        'thumb' => 'thumb.jpeg',
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\CodeFlix\Models\Video::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(3),
        'description' => $faker->sentence(5),
        'duration' => mt_rand(1,30),
        'file' => 'file.mp4',
        'thumb' => 'thumb.jpeg',
        'published' => mt_rand(0,1),
        'completed' => 1
    ];
});