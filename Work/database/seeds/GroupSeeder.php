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
                "department_id" => 1,
                "curs" => "4"
            ],
            [
                "group_name" => "Э-1-17", // 2
                "department_id" => 1,
                "curs" => "3"
            ],
            [
                "group_name" => "Э-1-18", //3
                "department_id" => 1,
                "curs" => "2"
            ],
            [
                "group_name" => "Э-11-17", //4
                "department_id" => 1,
                "curs" => "3"
            ],
            [
                "group_name" => "Э-11-18", //5
                "department_id" => 1,
                "curs" => "2"
            ],
            [
                "group_name" => "Э-11-19", //6
                "department_id" => 1,
                "curs" => "1"
            ],
            [
                "group_name" => "КС-1-16", //7
                "department_id" => 2,
                "curs" => "4"
            ],
            [
                "group_name" => "КС-1-17", //8
                "department_id" => 2,
                "curs" => "3"
            ],
            [
                "group_name" => "КС-2-16", //9
                "department_id" => 2,
                "curs" => "4"
            ],
            [
                "group_name" => "КС-2-17", //10
                "department_id" => 2,
                "curs" => "3"
            ],
            [
                "group_name" => "КС-11-17", //11
                "department_id" => 2,
                "curs" => "3"
            ],
            [
                "group_name" => "КС-11-18", //12
                "department_id" => 2,
                "curs" => "2"
            ],
            [
                "group_name" => "П-1-16", //13
                "department_id" => 3,
                "curs" => "4"
            ],
            [
                "group_name" => "П-1-17", //14
                "department_id" => 3,
                "curs" => "3"
            ],
            [
                "group_name" => "П-2-16", //15
                "department_id" => 3,
                "curs" => "4"
            ],
            [
                "group_name" => "П-2-17", //16
                "department_id" => 3,
                "curs" => "3"
            ],
            [
                "group_name" => "П-3-16", //17
                "department_id" => 3,
                "curs" => "4"
            ],
            [
                "group_name" => "П-11-18", //18
                "department_id" => 3,
                "curs" => "2"
            ],
            [
                "group_name" => "П-11-17", //19
                "department_id" => 3,
                "curs" => "3"
            ],
            [
                "group_name" => "ИС-1-16", //20
                "department_id" => 4,
                "curs" => "4"
            ],
            [
                "group_name" => "ИС-1-17", //21
                "department_id" => 4,
                "curs" => "3"
            ],
            [
                "group_name" => "ИС2-16", //22
                "department_id" => 4,
                "curs" => "4"
            ],
            [
                "group_name" => "ИС-2-17", //23
                "department_id" => 4,
                "curs" => "3"
            ],
            [
                "group_name" => "ИС-11-17", //24
                "department_id" => 4,
                "curs" => "3"
            ],
            [
                "group_name" => "ИС-11-18", //25
                "department_id" => 4,
                "curs" => "2"
            ],
            [
                "group_name" => "И-1-16", //26
                "department_id" => 5,
                "curs" => "4"
            ],
            [
                "group_name" => "И-1-17", //27
                "department_id" => 5,
                "curs" => "3"
            ],
            [
                "group_name" => "И-2-16", //28
                "department_id" => 5,
                "curs" => "4"
            ],
            [
                "group_name" => "И-2-17", //29
                "department_id" => 5,
                "curs" => "3"
            ],
            [
                "group_name" => "И-3-16", //30
                "department_id" => 5,
                "curs" => "4"
            ],
            [
                "group_name" => "И-11-18", //31
                "department_id" => 5,
                "curs" => "2"
            ],
            [
                "group_name" => "И-11-17", //32
                "department_id" => 5,
                "curs" => "3"
            ],
            [
                "group_name" => "СА50-11-18", //33
                "department_id" => 6,
                "curs" => "2"
            ],
            [
                "group_name" => "СА50-1-18", //34
                "department_id" => 6,
                "curs" => "2"
            ],
            [
                "group_name" => "СА50-2-18", //35
                "department_id" => 6,
                "curs" => "2"
            ],
            [
                "group_name" => "СА50-11-19", //36
                "department_id" => 6,
                "curs" => "1"
            ],
            [
                "group_name" => "ВД50-11-18", //37
                "department_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "БД50-1-18", //38
                "department_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "БД50-1-17", //39
                "department_id" => 7,
                "curs" => "3"
            ],
            [
                "group_name" => "ВД50-1-18", //40
                "department_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "ВД50-2-18", //41
                "department_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "ВД50-3-18", //42
                "department_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "ВД50-4-18", //43
                "department_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "ВД50-6-18", //44
                "department_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "ИС50-11-18", //45
                "department_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "ИС50-1-18", //46
                "department_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "ИС50-11-19", //47
                "department_id" => 7,
                "curs" => "1"
            ],
            [
                "group_name" => "ИС50-2-18", //48
                "department_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "П50-1-18", //49
                "department_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "П50-2-18", //50
                "department_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "П50-3-18", //51
                "department_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "П50-4-18", //52
                "department_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "П50-5-18", //53
                "department_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "П50-6-18", //54
                "department_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "П50-7-18", //55
                "department_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "Т50-11-18", //56
                "department_id" => 7,
                "curs" => "2"
            ],

            [
                "group_name" => "Т50-1-18", //57
                "department_id" => 7,
                "curs" => "2"
            ],
            [
                "group_name" => "БИ-11-18", //58
                "department_id" => 8,
                "curs" => "2"
            ],
            [
                "group_name" => "БИ50-1-17", //59
                "department_id" => 9,
                "curs" => "3"
            ],
            [
                "group_name" => "БИ50-1-18", //60
                "department_id" => 9,
                "curs" => "2"
            ],
            [
                "group_name" => "БИ50-11-19", //61
                "department_id" => 9,
                "curs" => "1"
            ],
            [
                "group_name" => "БИ50-11-18", //62
                "department_id" => 9,
                "curs" => "2"
            ],
            [
                "group_name" => "Ю-1-17", //63
                "department_id" => 10,
                "curs" => "3"
            ],
            [
                "group_name" => "Ю-1-18", //64
                "department_id" => 10,
                "curs" => "2"
            ],
            [
                "group_name" => "Ю-1-19", //65
                "department_id" => 10,
                "curs" => "1"
            ],
            [
                "group_name" => "Ю-11-19", //66
                "department_id" => 10,
                "curs" => "1"
            ],
            [
                "group_name" => "Ю-11-18", //67
                "department_id" => 10,
                "curs" => "2"
            ],
            [
                "group_name" => "Ю-2-17", //68
                "department_id" => 10,
                "curs" => "3"
            ]
        );
        DB::table("groups")->insert($date);
    }
}
