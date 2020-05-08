<?php

use Illuminate\Database\Seeder;

class GroupSeederExtention extends Seeder
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
                "group_name" => "Э-2-16",
                "department_id" => 1,
                "child_id"=>4,
                "curs" => "4"
            ],
            [
                "group_name" => "Э-2-17",
                "department_id" => 1,
                "child_id"=>5,
                "curs" => "3"
            ],
            [
                "group_name" => "Э-2-18",
                "department_id" => 1,
                "child_id"=>6,
                "curs" => "2"
            ],
            [
                "group_name" => "КС-3-16",
                "department_id" => 2,
                "child_id"=>11,
                "curs" => "4"
            ],
            [
                "group_name" => "КС-3-17",
                "department_id" => 2,
                "child_id"=>12,
                "curs" => "3"
            ],
            [
                "group_name" => "П-3-17",
                "department_id" => 3,
                "child_id"=>18,
                "curs" => "3"
            ],    
            [
                "group_name" => "П-4-16",
                "department_id" => 3,
                "child_id"=>19,
                "curs" => "4"
            ],
            [
                "group_name" => "ИС-3-16",
                "department_id" => 4,
                "child_id" => 24,
                "curs" => "4"
            ],
            [
                "group_name" => "ИС-3-17",
                "department_id" => 4,
                "child_id" => 25,
                "curs" => "3"
            ],
            [
                "group_name" => "И-3-17",
                "department_id" => 5,
                "child_id" => 31,
                "curs" => "3"
            ],
            [
                "group_name" => "И-4-16",
                "department_id" => 5,
                "child_id" => 32,
                "curs" => "4"
            ],
            [
                "group_name" => "СА50-1-17",
                "department_id" => 6,
                "child_id" => 33,
                "curs" => "3"
            ],
            [
                "group_name" => "СА50-3-18",
                "department_id" => 6,
                "child_id" => 36,
                "curs" => "2"
            ],  
            [
                "group_name" => "ВД50-1-17",
                "department_id" => 7,
                "child_id" => 37,
                "curs" => "3"
            ],
            [
                "group_name" => "ИС50-1-17",
                "department_id" => 7,
                "child_id" => 45,
                "curs" => "3"
            ],
            [
                "group_name" => "Т50-1-17",
                "department_id" => 7,
                "child_id" => 56,
                "curs" => "3"
            ],
            [
                "group_name" => "БИ-1-17",
                "department_id" => 8,
                "child_id" => 58,
                "curs" => "3"
            ],
            [
                "group_name" => "БИ50-2-17",
                "department_id" => 9,
                "child_id" => 62,
                "curs" => "3"
            ],
            [
                "group_name" => "БИ50-2-18",
                "department_id" => 9,
                "child_id" => 61,
                "curs" => "2"
            ],
        );
        DB::table("groups")->insert($date);
    }
}