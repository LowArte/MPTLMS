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
                "slug"=>"admin"
            ],
            [
                "name"=>"Студент",
                "slug"=>"student"
            ],
            [
                "name"=>"Преподаватель",
                "slug"=>"teacher"
            ],
            [
                "name"=>"Учебная часть",
                "slug"=>"unit"
            ],
            [
                "name"=>"Dark lord",
                "slug"=>"lord"
            ],
            [
                "name"=>"Ограниченный функционал",
                "slug"=>"nullfunc"
            ],
            [
                "name"=>"Редактор новостей",
                "slug"=>"editor"
            ],
        );
        DB::table("users_posts")->insert($date);
    }
}
