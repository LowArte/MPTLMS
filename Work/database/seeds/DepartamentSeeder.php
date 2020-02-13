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
                "dep_name_full" => "Обеспечение информационной безопасности в автоматизированных системах",
                "qualification" => "Специализация",
                "about" => "Об отделении",
                "image" => "Картинка",
                "info" => json_encode(('Информация')),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name" => "09.02.06",
                "dep_name_full" => "Сетевое и системное администрирование",
                "qualification" => "Специализация",
                "about" => "Об отделении",
                "image" => "Картинка",
                "info" => json_encode(('Информация')),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name" => "09.02.07",
                "dep_name_full" => "Информационные системы и программирование - Администратор баз данных ",
                "qualification" => "Специализация",
                "about" => "Об отделении",
                "image" => "Картинка",
                "info" => json_encode(('Информация')),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name" => "09.02.07",
                "dep_name_full" => "Информационные системы и программирование - Специалист по информационным системам ",
                "qualification" => "Специализация",
                "about" => "Об отделении",
                "image" => "Картинка",
                "info" => json_encode(('Информация')),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name" => "09.02.07",
                "dep_name_full" => "Информационные системы и программирование - Программист",
                "qualification" => "Специализация",
                "about" => "Об отделении",
                "image" => "Картинка",
                "info" => json_encode(('Информация')),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name" => "09.02.07",
                "dep_name_full" => "Информационные системы и программирование - Разработчик веб приложений",
                "qualification" => "Специализация",
                "about" => "Об отделении",
                "image" => "Картинка",
                "info" => json_encode(('Информация')),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name" => "09.02.07",
                "dep_name_full" => "Информационные системы и программирование - Специалист по тестированию",
                "qualification" => "Специализация",
                "about" => "Об отделении",
                "image" => "Картинка",
                "info" => json_encode(('Информация')),
                "studysperiod" => "3 года 10 месяцев"
            ],
            [
                "dep_name" => "40.02.01",
                "dep_name_full" => "Право и организация социального обеспечения",
                "qualification" => "Специализация",
                "about" => "Об отделении",
                "image" => "Картинка",
                "info" => json_encode(('Информация')),
                "studysperiod" => "3 года 10 месяцев"
            ]
        );
        DB::table("departaments")->insert($date);
    }
}
