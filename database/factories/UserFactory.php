<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    // Absolutely the WRONG way to 'salt' a password, found from the wild back in the day
    $salt = uniqid('', false);

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => '$2y$10$MFk24.OzGjGIRtEF3lgGeuD.m5ZFJ3YZCGSF5BYCZuwz4BYQBIXpG', // bcrypt('password')
        'remember_token' => Str::random(10),
    ];
});
