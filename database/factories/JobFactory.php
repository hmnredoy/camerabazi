<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {

    $title = $faker->sentence;
    //$slug = Str::slug($title);
    return [
        'location_id' =>  function(){
        return factory(\App\Models\Location::class)->create()->id;
        } ,

        'user_id' =>  function(){
            return factory(\App\Models\User::class)->create()->id;
        } ,
        'title' => $title,
        'description' => $faker->paragraph,
        'expire' => $faker->dateTimeBetween(now(),'1 month'),
//        'status' => $faker->numberBetween(1,4),
        'status' => \App\Models\Enums\JobStatus::Active,
        'budget' => $faker->randomFloat()

    ];
});
