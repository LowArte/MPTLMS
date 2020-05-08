<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array();
        $users = User::where('post_id', 2)->get();
        $faker = Faker\Factory::create();
        for ($i = 0; $i < count($users); $i++) {
            array_push(
                $data,
                array(
                    'user_id' => $users[$i]['id'],
                    'group_id' => $users[$i]['thirdName'],
                    'type_of_financing' => "Бюджет",
                    'gender' => "Мужской",
                    'birthday' => $faker->dateTime($max = 'now', $timezone = null),
                )
            );
        }
        DB::table("students")->insert($data);
    }
}