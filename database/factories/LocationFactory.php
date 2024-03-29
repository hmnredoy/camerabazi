<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Location;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'status' => $faker->numberBetween(0,1),
    ];
});
