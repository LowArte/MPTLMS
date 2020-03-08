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
                "group_name" => "БИ50",
                "departament_id" => 1,
                "group_number" => "1",
                "group_year" => "17",
                "сurs" => "4"
            ],
            [
                "group_name" => "СА50",
                "departament_id" => 2,
                "group_number" => "1",
                "group_year" => "17",
                "сurs" => "4"
            ],
            [
                "group_name" => "БД50",
                "departament_id" => 3,
                "group_number" => "1",
                "group_year" => "17",
                "сurs" => "4"
            ],
            [
                "group_name" => "ИС50",
                "departament_id" => 4,
                "group_number" => "1",
                "group_year" => "17",
                "сurs" => "4"
            ],
            [
                "group_name" => "П50",
                "departament_id" => 5,
                "group_number" => "1",
                "group_year" => "17",
                "сurs" => "4"
            ],
            [
                "group_name" => "ВД50",
                "departament_id" => 6,
                "group_number" => "1",
                "group_year" => "17",
                "сurs" => "4"
            ],
            [
                "group_name" => "Т50",
                "departament_id" => 7,
                "group_number" => "1",
                "group_year" => "17",
                "сurs" => "4"
            ],
            [
                "group_name" => "Ю",
                "departament_id" => 8,
                "group_number" => "1",
                "group_year" => "17",
                "сurs" => "4"
            ],
            [
                "group_name" => "БИ50",
                "departament_id" => 1,
                "group_number" => "2",
                "group_year" => "17",
                "сurs" => "4"
            ],
            [
                "group_name" => "СА50",
                "departament_id" => 2,
                "group_number" => "1",
                "group_year" => "18",
                "сurs" => "4"
            ],
            [
                "group_name" => "БД50",
                "departament_id" => 3,
                "group_number" => "1",
                "group_year" => "18",
                "сurs" => "4"
            ],
            [
                "group_name" => "ИС50",
                "departament_id" => 4,
                "group_number" => "1",
                "group_year" => "18",
                "сurs" => "4"
            ],
            [
                "group_name" => "П50",
                "departament_id" => 5,
                "group_number" => "1",
                "group_year" => "18",
                "сurs" => "4"
            ],
            [
                "group_name" => "ВД50",
                "departament_id" => 6,
                "group_number" => "1",
                "group_year" => "18",
                "сurs" => "4"
            ],
            [
                "group_name" => "Т50",
                "departament_id" => 7,
                "group_number" => "1",
                "group_year" => "18",
                "сurs" => "4"
            ],
            [
                "group_name" => "Ю",
                "departament_id" => 8,
                "group_number" => "1",
                "group_year" => "18",
                "сurs" => "4"
            ]
        );
        DB::table("groups")->insert($date);
    }
}
