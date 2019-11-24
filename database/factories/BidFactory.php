<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Bid;
use Faker\Generator as Faker;

$factory->define(Bid::class, function (Faker $faker) {
    return [
        'delivery_days' => $faker->numberBetween(1,7),
        'amount' => $faker->randomNumber(),
        'description'=>$faker->sentence,
        'freelancer_id' => function(){
            return factory(\App\Models\User::class)->create()->id;
        },
        'job_id' => function(){
            return factory(\App\Models\Job::class)->create()->id;
        },
        'is_accepted'=>false,
    ];
});
