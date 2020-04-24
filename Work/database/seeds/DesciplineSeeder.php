<?php

use Illuminate\Database\Seeder;

class DesciplineSeeder extends Seeder
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
                "discipline_name"=>"Иностранный язык",
            ],
            [
                "discipline_name"=>"Физическая культура",
            ],
            [
                "discipline_name"=>"Основы экономики",
            ],
            [
                "discipline_name"=>"Правовое обеспечение профессиональной деятельности",
            ],
            [
                "discipline_name"=>"Компьютерное делопроизводство",
            ],
            [
                "discipline_name"=>"Этика и психология профессиональной деятельности",
            ],
            [
                "discipline_name"=>"Технология мультимедия",
            ],
            [
                "discipline_name"=>"Практика",
            ]
        );
        DB::table("disciplines")->insert($date);
    }
}
