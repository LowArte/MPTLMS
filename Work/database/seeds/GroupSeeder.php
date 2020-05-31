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
                "group_name" => "И-1-16", //1
                "department_id" => 5,
                "curs" => "4"
            ],
            [
                "group_name" => "И-1-17", //2
                "department_id" => 5,
                "curs" => "3"
            ],
            [
                "group_name" => "И-2-16", //3
                "department_id" => 5,
                "curs" => "4"
            ],
            [
                "group_name" => "И-2-17", //4
                "department_id" => 5,
                "curs" => "3"
            ],
            [
                "group_name" => "И-3-16", //5
                "department_id" => 5,
                "curs" => "4"
            ],
            [
                "group_name" => "И-11-18", //6
                "department_id" => 5,
                "curs" => "2"
            ],
            [
                "group_name" => "И-11-17", //7
                "department_id" => 5,
                "curs" => "3"
            ],
        );
        DB::table("groups")->insert($date);
    }
}
