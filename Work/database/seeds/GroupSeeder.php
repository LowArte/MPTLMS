<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
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
                "group_name"=>"БИ50-1-17",
                "departaments_id"=>1,
                "study_period" => "3 года 10 месяцев",
                "type_of_study" =>"Очная",
                "сurs"=>"4"       
            ],
            [
                "group_name"=>"СА50-1-17",
                "departaments_id"=>2,
                "study_period" => "3 года 10 месяцев",
                "type_of_study" =>"Очная",
                "сurs"=>"4"     
            ],
            [
                "group_name"=>"БД50-1-17",
                "departaments_id"=>3,
                "study_period" => "3 года 10 месяцев",
                "type_of_study" =>"Очная",
                "сurs"=>"4"     
            ],
            [
                "group_name"=>"ИС50-1-17",
                "departaments_id"=>4,
                "study_period" => "3 года 10 месяцев",
                "type_of_study" =>"Очная",
                "сurs"=>"4"     
            ],
            [
                "group_name"=>"П50-1-17",
                "departaments_id"=>5,
                "study_period" => "3 года 10 месяцев",
                "type_of_study" =>"Очная",
                "сurs"=>"4"     
            ],
            [
                "group_name"=>"ВД50-1-17",
                "departaments_id"=>6,
                "study_period" => "3 года 10 месяцев",
                "type_of_study" =>"Очная",
                "сurs"=>"4"     
            ],
            [
                "group_name"=>"Т50-1-17",
                "departaments_id"=>7,
                "study_period" => "3 года 10 месяцев",
                "type_of_study" =>"Очная",
                "сurs"=>"4"     
            ],
            [
                "group_name"=>"Ю-1-17",
                "departaments_id"=>8,
                "study_period" => "3 года 10 месяцев",
                "type_of_study" =>"Очная",
                "сurs"=>"4"     
            ],
            [
                "group_name"=>"БИ50-2-17",
                "departaments_id"=>1,
                "study_period" => "3 года 10 месяцев",
                "type_of_study" =>"Очная",
                "сurs"=>"4"     
            ],
            [
                "group_name"=>"СА50-1-18",
                "departaments_id"=>2,
                "study_period" => "3 года 10 месяцев",
                "type_of_study" =>"Очная",
                "сurs"=>"4"     
            ],
            [
                "group_name"=>"БД50-1-18",
                "departaments_id"=>3,
                "study_period" => "3 года 10 месяцев",
                "type_of_study" =>"Очная",
                "сurs"=>"4"     
            ],
            [
                "group_name"=>"ИС50-1-18",
                "departaments_id"=>4,
                "study_period" => "3 года 10 месяцев",
                "type_of_study" =>"Очная",
                "сurs"=>"4"     
            ],
            [
                "group_name"=>"П50-1-18",
                "departaments_id"=>5,
                "study_period" => "3 года 10 месяцев",
                "type_of_study" =>"Очная",
                "сurs"=>"4"     
            ],
            [
                "group_name"=>"ВД50-1-18",
                "departaments_id"=>6,
                "study_period" => "3 года 10 месяцев",
                "type_of_study" =>"Очная",
                "сurs"=>"4"     
            ],
            [
                "group_name"=>"Т50-1-18",
                "departaments_id"=>7,
                "study_period" => "3 года 10 месяцев",
                "type_of_study" =>"Очная",
                "сurs"=>"4"     
            ],
            [
                "group_name"=>"Ю-1-18",
                "departaments_id"=>8,
                "study_period" => "3 года 10 месяцев",
                "type_of_study" =>"Очная",
                "сurs"=>"4"     
            ]
        );
        DB::table("groups")->insert($date);
    }
}
