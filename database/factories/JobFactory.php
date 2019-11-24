<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {

    $title = $faker->sentence;
    $slug = str_slug($faker->sentence, '-');

    return [
        'location_id' =>  function(){
        return factory(\App\Models\Location::class)->create()->id;
        } ,

        'user_id' =>  function(){
            return factory(\App\Models\User::class)->create()->id;
        } ,
        'slug' => $slug,
        'title' => $title,
        'description' => $faker->paragraph,
        'expire' => $faker->dateTimeBetween(now(),'1 month'),
        'status' => $faker->numberBetween(1,4),
        'budget' => $faker->randomFloat()

    ];
});
