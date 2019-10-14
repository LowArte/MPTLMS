<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    $pass = $faker->password();
    return [
        'name'=>$faker->firstName(),
        'secName'=>$faker->lastName(),
        'thirdName'=>$faker->lastName(),
        'email'=>$faker->email(),
        'password' =>Hash::make($pass),
        'password_notHash' =>$pass,
        'post_id' =>rand(1,6),
        'created_at'=>$faker->dateTime($max = 'now', $timezone = null),
        'updated_at'=>$faker->dateTime($max = 'now', $timezone = null)
    ];
});

