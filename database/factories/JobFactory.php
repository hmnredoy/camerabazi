<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'location_id' =>  function(){
        return factory(\App\Models\Location::class)->create()->id;
        } ,
        'category_id' =>  function(){
            return factory(\App\Models\Category::class)->create()->id;
        } ,
        'user_id' =>  function(){
            return factory(\App\Models\User::class)->create()->id;
        } ,
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'expire' => $faker->dateTimeBetween(now(),'1 month'),
        'budget' => $faker->randomFloat()

    ];
});