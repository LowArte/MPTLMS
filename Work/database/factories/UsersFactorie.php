<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Users::class, function (Faker $faker) {
    return [
        'login_email'=>$faker->email(),
        'login_stud'=>$faker->creditCardNumber(),
        'password' =>$faker->password(),
        'post_id' =>rand(1,6),
        'created_at'=>$faker->dateTime($max = 'now', $timezone = null),
        'updated_at'=>$faker->dateTime($max = 'now', $timezone = null)
    ];
});

