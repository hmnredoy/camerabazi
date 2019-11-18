<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FreelancerAccount;
use Faker\Generator as Faker;

$factory->define(FreelancerAccount::class, function (Faker $faker) {
    return [
        'bid' => $faker->randomNumber(),
        'coin' => $faker->randomNumber(),
        'balance' => $faker->randomNumber(),
        'freelancer_id' => factory(\App\Models\User::class)->create(['role_id'=>1])->id
    ];
});
