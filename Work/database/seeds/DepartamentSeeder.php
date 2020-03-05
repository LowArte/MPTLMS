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
                "dep_name_full" => "Обеспечение информационной безопасности в автоматизированных системах",
                "qualification" => "Специализация",
                "image" => "Картинка",
                "info" => json_encode(('Информация')),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name_full" => "Сетевое и системное администрирование",
                "qualification" => "Специализация",
                "image" => "Картинка",
                "info" => json_encode(('Информация')),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name_full" => "Информационные системы и программирование - Администратор баз данных ",
                "qualification" => "Специализация",
                "image" => "Картинка",
                "info" => json_encode(('Информация')),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name_full" => "Информационные системы и программирование - Специалист по информационным системам ",
                "qualification" => "Специализация",
                "image" => "Картинка",
                "info" => json_encode(('Информация')),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name_full" => "Информационные системы и программирование - Программист",
                "qualification" => "Специализация",
                "image" => "Картинка",
                "info" => json_encode(('Информация')),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name_full" => "Информационные системы и программирование - Разработчик веб приложений",
                "qualification" => "Специализация",
                "image" => "Картинка",
                "info" => json_encode(('Информация')),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name_full" => "Информационные системы и программирование - Специалист по тестированию",
                "qualification" => "Специализация",
                "image" => "Картинка",
                "info" => json_encode(('Информация')),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name_full" => "Право и организация социального обеспечения",
                "qualification" => "Специализация",
                "image" => "Картинка",
                "info" => json_encode(('Информация')),
                "studysperiod" => "3 года 10 месяцев"
            ]
        );
        DB::table("departaments")->insert($date);
    }
}
