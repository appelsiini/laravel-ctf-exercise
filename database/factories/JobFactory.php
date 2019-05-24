<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle,
        'description' => $faker->text(500)
    ];
});
