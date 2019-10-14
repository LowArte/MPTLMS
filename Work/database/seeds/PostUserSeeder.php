<?php

use Illuminate\Database\Seeder;

class PostUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = array(
            [
                "name"=>"Администратор",
            ],
            [
                "name"=>"Студент",
            ],
            [
                "name"=>"Преподаватель",
            ],
            [
                "name"=>"Учебная часть",
            ],
            [
                "name"=>"Dark lord",
            ],
            [
                "name"=>"Ограниченный функционал",
            ],
        );
        DB::table("users_posts")->insert($date);
    }
}
