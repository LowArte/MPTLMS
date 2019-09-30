<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Student::class, function (Faker $faker) {
    return [
        'user_id'=>$faker->unique()->numberBetween(1,100),
        'group_id'=>rand(1,16),
        'created_at'=>$faker->dateTime($max = 'now', $timezone = null),
        'updated_at'=>$faker->dateTime($max = 'now', $timezone = null)
    ];
});
