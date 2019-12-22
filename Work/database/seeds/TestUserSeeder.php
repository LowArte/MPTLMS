<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory;



class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array();
        $faker = Factory::create();
        //Админ
        array_push($data,
            array(
                'name'=>$faker->firstName(),
                'secName'=>$faker->lastName(),
                'thirdName'=>$faker->lastName(),
                'email'=>'admin@mpt.ru',
                'password' =>Hash::make('admin'),
                'password_notHash' =>'admin',
                'disabled' =>false,
                'post_id' =>1,
                'created_at'=>$faker->dateTime($max = 'now', $timezone = null),
                'updated_at'=>$faker->dateTime($max = 'now', $timezone = null)
            )
        );
        //Студент
        array_push($data,
            array(
                'name'=>$faker->firstName(),
                'secName'=>$faker->lastName(),
                'thirdName'=>$faker->lastName(),
                'email'=>'student@mpt.ru',
                'password' =>Hash::make('student'),
                'password_notHash' =>'student',
                'disabled' =>false,
                'post_id' =>2,
                'created_at'=>$faker->dateTime($max = 'now', $timezone = null),
                'updated_at'=>$faker->dateTime($max = 'now', $timezone = null)
            )
        );
        //Преподаватель
        array_push($data,
            array(
                'name'=>$faker->firstName(),
                'secName'=>$faker->lastName(),
                'thirdName'=>$faker->lastName(),
                'email'=>'teacher@mpt.ru',
                'password' =>Hash::make('teacher'),
                'password_notHash' =>'teacher',
                'disabled' =>false,
                'post_id' =>3,
                'created_at'=>$faker->dateTime($max = 'now', $timezone = null),
                'updated_at'=>$faker->dateTime($max = 'now', $timezone = null)
            )
        );
        //Учебная часть
        array_push($data,
            array(
                'name'=>$faker->firstName(),
                'secName'=>$faker->lastName(),
                'thirdName'=>$faker->lastName(),
                'email'=>'unit@mpt.ru',
                'password' =>Hash::make('unit'),
                'password_notHash' =>'unit',
                'disabled' =>false,
                'post_id' =>4,
                'created_at'=>$faker->dateTime($max = 'now', $timezone = null),
                'updated_at'=>$faker->dateTime($max = 'now', $timezone = null)
            )
        );
        //Канцелярия
        array_push($data,
            array(
                'name'=>$faker->firstName(),
                'secName'=>$faker->lastName(),
                'thirdName'=>$faker->lastName(),
                'email'=>'darklord@mpt.ru',
                'password' =>Hash::make('darklord'),
                'password_notHash' =>'darklord',
                'disabled' =>false,
                'post_id' =>5,
                'created_at'=>$faker->dateTime($max = 'now', $timezone = null),
                'updated_at'=>$faker->dateTime($max = 'now', $timezone = null)
            )
        );
        //Ограниченный функционал
        array_push($data,
            array(
                'name'=>$faker->firstName(),
                'secName'=>$faker->lastName(),
                'thirdName'=>$faker->lastName(),
                'email'=>'limited@mpt.ru',
                'password' =>Hash::make('limited'),
                'password_notHash' =>'limited',
                'disabled' =>false,
                'post_id' =>6,
                'created_at'=>$faker->dateTime($max = 'now', $timezone = null),
                'updated_at'=>$faker->dateTime($max = 'now', $timezone = null)
            )
        );
        DB::table("users")->insert($data);
    }
}
