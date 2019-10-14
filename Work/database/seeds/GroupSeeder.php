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
                "departaments_id"=>1
            ],
            [
                "group_name"=>"СА50-1-17",
                "departaments_id"=>2
            ],
            [
                "group_name"=>"БД50-1-17",
                "departaments_id"=>3
            ],
            [
                "group_name"=>"ИС50-1-17",
                "departaments_id"=>4
            ],
            [
                "group_name"=>"П50-1-17",
                "departaments_id"=>5
            ],
            [
                "group_name"=>"ВД50-1-17",
                "departaments_id"=>6
            ],
            [
                "group_name"=>"Т50-1-17",
                "departaments_id"=>7
            ],
            [
                "group_name"=>"Ю-1-17",
                "departaments_id"=>8
            ],
            [
                "group_name"=>"БИ50-2-17",
                "departaments_id"=>1
            ],
            [
                "group_name"=>"СА50-1-18",
                "departaments_id"=>2
            ],
            [
                "group_name"=>"БД50-1-18",
                "departaments_id"=>3
            ],
            [
                "group_name"=>"ИС50-1-18",
                "departaments_id"=>4
            ],
            [
                "group_name"=>"П50-1-18",
                "departaments_id"=>5
            ],
            [
                "group_name"=>"ВД50-1-18",
                "departaments_id"=>6
            ],
            [
                "group_name"=>"Т50-1-18",
                "departaments_id"=>7
            ],
            [
                "group_name"=>"Ю-1-18",
                "departaments_id"=>8
            ]
        );
        DB::table("groups")->insert($date);
    }
}
