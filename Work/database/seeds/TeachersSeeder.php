<?php

use App\User;
use Illuminate\Database\Seeder;



class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array();
        $users = User::where('post_id', 3)->get();
        $faker = Faker\Factory::create();
        for ($i = 0; $i < count($users); $i++) {
            array_push(
                $data,
                array(
                    'user_id' => $users[$i]['id'],
                    'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                    'updated_at' => $faker->dateTime($max = 'now', $timezone = null)
                )
            );
        }
        DB::table("teachers")->insert($data);
    }
}
