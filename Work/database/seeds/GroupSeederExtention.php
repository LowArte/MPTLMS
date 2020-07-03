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
                "group_name" => "И-3-17",
                "department_id" => 5,
                "child_id" => 6,
                "curs" => "3"
            ],
            [
                "group_name" => "И-4-16",
                "department_id" => 5,
                "child_id" => 7,
                "curs" => "4"
            ],
        );
        DB::table("groups")->insert($date);
    }
}