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
                "group_name" => "Э-1-16", // 1
                "departament_id" => 1,
                "curs" => "4"
            ],
            [
                "group_name" => "Э-1-17", // 2
                "departament_id" => 1,
                "curs" => "3"
            ],
            [
                "group_name" => "Э-1-18", //3
                "departament_id" => 1,
                "curs" => "2"
            ],
            [
                "group_name" => "Э-11-17", //4
                "departament_id" => 1,
                "curs" => "3"
            ],
            [
                "group_name" => "Э-11-18", //5
                "departament_id" => 1,
                "curs" => "2"
            ],
            [
                "group_name" => "Э-11-19", //6
                "departament_id" => 1,
                "curs" => "1"
            ],
            [
                "group_name" => "КС-1-16", //7
                "departament_id" => 2,
                "curs" => "4"
            ],
            [
                "group_name" => "КС-1-17", //8
                "departament_id" => 2,
                "curs" => "3"
            ],
            [
                "group_name" => "КС-2-16", //9
                "departament_id" => 2,
                "curs" => "4"
            ],
            [
                "group_name" => "КС-2-17", //10
                "departament_id" => 2,
                "curs" => "3"
            ],
            [
                "group_name" => "КС-11-17", //11
                "departament_id" => 2,
                "curs" => "3"
            ],
            [
                "group_name" => "КС-11-18", //12
                "departament_id" => 2,
                "curs" => "2"
            ],
            [
                "group_name" => "П-1-16", //13
                "departament_id" => 3,
                "curs" => "4"
            ],
            [
                "group_name" => "П-1-17", //14
                "departament_id" => 3,
                "curs" => "3"
            ],
            [
                "group_name" => "П-2-16", //15
                "departament_id" => 3,
                "curs" => "4"
            ],
            [
                "group_name" => "П-2-17", //16
                "departament_id" => 3,
                "curs" => "3"
            ],
            [
                "group_name" => "П-3-16", //17
                "departament_id" => 3,
                "curs" => "4"
            ],
            [
                "group_name" => "П-11-18", //18
                "departament_id" => 3,
                "curs" => "2"
            ],
            [
                "group_name" => "П-11-17", //19
                "departament_id" => 3,
                "curs" => "3"
            ],
            [
                "group_name" => "ИС-1-16", //20
                "departament_id" => 4,
                "curs" => "4"
            ],
            [
                "group_name" => "ИС-1-17", //21
                "departament_id" => 4,
                "curs" => "3"
            ],
            [
                "group_name" => "ИС2-16", //22
                "departament_id" => 4,
                "curs" => "4"
            ],
            [
                "group_name" => "ИС-2-17", //23
                "departament_id" => 4,
                "curs" => "3"
            ],
            [
                "group_name" => "ИС-11-17", //24
                "departament_id" => 4,
                "curs" => "3"
            ],
            [
                "group_name" => "ИС-11-18", //25
                "departament_id" => 4,
                "curs" => "2"
            ],
            [
                "group_name" => "И-1-16", //26
                "departament_id" => 5,
                "curs" => "4"
            ],
            [
                "group_name" => "И-1-17", //27
                "departament_id" => 5,
                "curs" => "3"
            ],
            [
                "group_name" => "И-2-16", //28
                "departament_id" => 5,
                "curs" => "4"
            ],
            [
                "group_name" => "И-2-17", //29
                "departament_id" => 5,
                "curs" => "3"
            ],
            [
                "group_name" => "И-3-16", //30
                "departament_id" => 5,
                "curs" => "4"
            ],
            [
                "group_name" => "И-11-18", //31
                "departament_id" => 5,
                "curs" => "2"
            ],
            [
                "group_name" => "И-11-17", //32
                "departament_id" => 5,
                "curs" => "3"
            ],
            [
                "group_name" => "СА50-11-18", //33
                "departament_id" => 6,
                "curs" => "2"
            ],
            [
                "group_name" => "СА50-1-18", //34
                "departament_id" => 6,
                "curs" => "2"
            ],
            [
                "group_name" => "СА50-2-18", //35
                "departament_id" => 6,
                "curs" => "2"
            ],
            [
                "group_name" => "СА50-11-19", //36
                "departament_id" => 6,
                "curs" => "1"
            ],
            [
                "group_name" => "ВД50-11-18", //37
                "departament_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "БД50-1-18", //38
                "departament_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "БД50-1-17", //39
                "departament_id" => 7,
                "curs" => "3"
            ],
            [
                "group_name" => "ВД50-1-18", //40
                "departament_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "ВД50-2-18", //41
                "departament_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "ВД50-3-18", //42
                "departament_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "ВД50-4-18", //43
                "departament_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "ВД50-6-18", //44
                "departament_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "ИС50-11-18", //45
                "departament_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "ИС50-1-18", //46
                "departament_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "ИС50-11-19", //47
                "departament_id" => 7,
                "curs" => "1"
            ],
            [
                "group_name" => "ИС50-2-18", //48
                "departament_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "П50-1-18", //49
                "departament_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "П50-2-18", //50
                "departament_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "П50-3-18", //51
                "departament_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "П50-4-18", //52
                "departament_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "П50-5-18", //53
                "departament_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "П50-6-18", //54
                "departament_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "П50-7-18", //55
                "departament_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "Т50-11-18", //56
                "departament_id" => 7,
                "curs" => "2"
            ],

            [
                "group_name" => "Т50-1-18", //57
                "departament_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "БИ-11-18", //58
                "departament_id" => 8,
                "curs" => "2"
            ],
            [
                "group_name" => "БИ50-1-17", //59
                "departament_id" => 9,
                "curs" => "3"
            ],
            [
                "group_name" => "БИ50-1-18", //60
                "departament_id" => 9,
                "curs" => "2"
            ],
            [
                "group_name" => "БИ50-11-19", //61
                "departament_id" => 9,
                "curs" => "1"
            ],
            [
                "group_name" => "БИ50-11-18", //62
                "departament_id" => 9,
                "curs" => "2"
            ],
            [
                "group_name" => "Ю-1-17", //63
                "departament_id" => 10,
                "curs" => "3"
            ],
            [
                "group_name" => "Ю-1-18", //64
                "departament_id" => 10,
                "curs" => "2"
            ],
            [
                "group_name" => "Ю-1-19", //65
                "departament_id" => 10,
                "curs" => "1"
            ],
            [
                "group_name" => "Ю-11-19", //66
                "departament_id" => 10,
                "curs" => "1"
            ],
            [
                "group_name" => "Ю-11-18", //67
                "departament_id" => 10,
                "curs" => "2"
            ],
            [
                "group_name" => "Ю-2-17", //68
                "departament_id" => 10,
                "curs" => "3"
            ]
        );
        DB::table("groups")->insert($date);
    }
}
