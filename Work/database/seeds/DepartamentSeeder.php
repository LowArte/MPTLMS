<?php

use Illuminate\Database\Seeder;

class DepartamentSeeder extends Seeder
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
                "dep_name" => "10.02.05",
                "dep_name_full" => "10.02.05 Обеспечение информационной безопасности в автоматизированных системах",
                "specialization" => "Специализация"
            ],
            [
                "dep_name" => "09.02.06",
                "dep_name_full" => "09.02.06 Сетевое и системное администрирование",
                "specialization" => "Специализация"
            ],
            [
                "dep_name" => "09.02.07",
                "dep_name_full" => "09.02.07(БД) Информационные системы и программирование - Администратор баз данных ",
                "specialization" => "Специализация"
            ],
            [
                "dep_name" => "09.02.07",
                "dep_name_full" => "09.02.07(ИС) Информационные системы и программирование - Специалист по информационным системам ",
                "specialization" => "Специализация"
            ],
            [
                "dep_name" => "09.02.07",
                "dep_name_full" => "09.02.07(П) Информационные системы и программирование - Программист",
                "specialization" => "Специализация"
            ],
            [
                "dep_name" => "09.02.07",
                "dep_name_full" => "09.02.07(ВД) Информационные системы и программирование - Разработчик веб приложений",
                "specialization" => "Специализация"
            ],
            [
                "dep_name" => "09.02.07",
                "dep_name_full" => "09.02.07(Т) Информационные системы и программирование - Специалист по тестированию ",
                "specialization" => "Специализация"
            ],
            [
                "dep_name" => "40.02.01",
                "dep_name_full" => "40.02.01 Право и организация социального обеспечения",
                "specialization" => "Специализация"
            ]
        );
        DB::table("departaments")->insert($date);
    }
}
