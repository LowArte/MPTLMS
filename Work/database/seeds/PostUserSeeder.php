<?php

use Illuminate\Database\Seeder;

class PostUserSeeder extends Seeder
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
                "name" => "Администратор",
                "slug" => "admin",
                "privilegies" => json_encode([
                    [
                        "id" => 1,
                        "icon" => "home",
                        "text" => "Главная",
                        "component" => [
                            "info" => [
                                "name" => "Домашняя страница",
                                "url" => ""
                            ],
                            "path" => "@/js/views/homes-f/AdminHome"
                        ],
                        "default" => true
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "settings_brightness",
                        "text" => "Панель управления",
                        "default" => true,
                        "children" => [
                            [
                                "id" => uniqid(),
                                "text" => "Настройки сервера",
                                "component" => [
                                    "info" => [
                                        "name" => "Настройки сервера",
                                        "url"=> "server_settings"
                                    ],
                                    "path" => "@/js/views/administrator-f/PanelControl"
                                ],
                                "default" => true
                            ]
                        ]
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "assignment",
                        "text" => "Расписания",
                        "children" => [
                            [
                                "id" => uniqid(),
                                "text" => "Учебное расписание",
                                "component" => [
                                    "info" => [
                                        "name" => "Учебное рассписение",
                                        "url"=> "timetable"
                                    ],
                                    "path" => "@/js/views/timetable-f/Timetable"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Изменения в расписании",
                                "component" => [
                                    "info" => [
                                        "name" => "Замены рассписения",
                                        "url"=> "replacements"
                                    ],
                                    "path" => "@/js/views/replacements-f/Replacements"
                                ],

                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Расписание звонков",
                                "component" => [
                                    "info" => [
                                        "name" => "Рассписание звонков",
                                        "url"=> "callschedule"
                                    ],
                                    "path" => "@/js/views/call-schedule-f/CallSchedule"
                                 ],
                            ]
                        ],

                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "sd_storage",
                        "text" => "База данных",
                        "children" => [
                            [
                                "id" => uniqid(),
                                "text" => "Пользователи",
                                "component" => [
                                    "info" => [
                                        "name" => "CRUD пользователей",
                                        "url"=> "users_crud"
                                    ],
                                    "path" => "@/js/views/administrator-f/CRUD/CRUDUser"
                                 ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Роли",
                                "component" => [
                                    "info" => [
                                        "name" => "CRUD роли",
                                        "url"=> "posts_crud"
                                    ],
                                    "path" => "@/js/views/administrator-f/CRUD/CRUDPost"
                                 ],

                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Отделения",
                                "component" => [
                                    "info" => [
                                        "name" => "CRUD отделений",
                                        "url"=> "departaments_crud"
                                    ],
                                    "path" => "@/js/views/administrator-f/CRUD/CRUDDepartament"
                                 ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Группы",
                                "component" => [
                                    "info" => [
                                        "name" => "CRUD групп",
                                        "url"=> "groups_crud"
                                    ],
                                    "path" => "@/js/views/administrator-f/CRUD/CRUDGroup"
                                 ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Места проведения",
                                "component" => [
                                    "info" => [
                                        "name" => "CRUD мест проведения",
                                        "url"=> "places_crud"
                                    ],
                                    "path" => "@/js/views/administrator-f/CRUD/CRUDPlace"
                                 ],
                            ]
                        ],

                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обращение пользователей",
                        "children" => [],
                        "component" => [
                            "info" => [
                                "name" => "Просмотр обращений пользователей",
                                "url"=> "requests"
                            ],
                            "path" => "@/js/views/feedback-f/Request"
                         ],
                    ]
                ])
            ],
            [
                "name" => "Студент",
                "slug" => "student",
                "privilegies" => json_encode([
                    [
                        "id" => 1,
                        "icon" => "home",
                        "text" => "Главная",
                        "component" => [
                            "info" => [
                                "name" => "Домашняя страница",
                                "url" => ""
                            ],
                            "path" => "@/js/views/homes-f/DefaultHome"
                        ],
                        "default" => true
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "portrait",
                        "text" => "Мой профиль",
                        "component" => null,
                        "children" => []   
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "whatshot",
                        "text" => "Новости",
                        "component" => null,
                        "children" => []   
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "school",
                        "text" => "Учебные процесс",
                        "children" => [
                            [
                                "id" => uniqid(),
                                "text" => "Расписание занятий",
                                "component" => null,
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Изменения в расписании",
                                "component" => null,
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Расписание экзаменов",
                                "component" => null,
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Успеваемость",
                                "component" => null,
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Домашнее задание",
                                "component" => null,
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Преподаватели",
                                "component" => null,
                            ]
                        ],
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "beenhere",
                        "text" => "Услуги",
                        "children" => [
                            [
                                "id" => uniqid(),
                                "text" => "Справки и характеристики",
                                "component" => null,
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Психолог",
                                "component" => null,
                            ]
                        ],
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "cloud",
                        "text" => "Хранилище данных",
                        "children" => null,
                        "children" => []   
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "layers",
                        "text" => "Базы практики",
                        "children" => null,
                        "children" => []   
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обратная связь",
                        "component" => null,
                        "default" => true
                    ]
                ]),
            ],
            [
                "name" => "Преподаватель",
                "slug" => "teacher",
                "privilegies" => json_encode([
                    [
                        "id" => 1,
                        "icon" => "home",
                        "text" => "Главная",
                        "component" => [
                            "info" => [
                                "name" => "Домашняя страница",
                                "url" => ""
                            ],
                            "path" => "@/js/views/homes-f/Home"
                        ],
                        "default" => true
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "school",
                        "text" => "Учебные процесс",
                        "children" => [
                            [
                                "id" => uniqid(),
                                "text" => "Учебное раписание",
                                "component" => null,
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Изменения в расписании",
                                "component" => null,
                            ],
                        ],
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "class",
                        "text" => "Учебные журналы",
                        "component" => null,
                        "children" => []   
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обратная связь",
                        "component" => null,
                        "default" => true
                    ]
                ]),
            ],
            [
                "name" => "Учебная часть",
                "slug" => "unit",
                "privilegies" => json_encode([
                    [
                        "id" => 1,
                        "icon" => "home",
                        "text" => "Главная",
                        "component" => [
                            "info" => [
                                "name" => "Домашняя страница",
                                "url" => ""
                            ],
                            "path" => "@/js/views/homes-f/Home"
                        ],
                        "default" => true
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "assignment",
                        "text" => "Расписания",
                        "children" => [
                            [
                                "id" => uniqid(),
                                "text" => "Учебное раписание",
                                "component" => null,
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Изменения в расписании",
                                "component" => null,
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Расписание звонков",
                                "component" => null,
                            ]
                        ],
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обратная связь",
                        "component" => null,
                        "default" => true
                    ]
                ]),
            ],
            [
                "name" => "Канцелярия",
                "slug" => "chancellery",
                "privilegies" => json_encode([
                    [
                        "id" => 1,
                        "icon" => "home",
                        "text" => "Главная",
                        "component" => [
                            "info" => [
                                "name" => "Домашняя страница",
                                "url" => ""
                            ],
                            "path" => "@/js/views/homes-f/Home"
                        ],
                        "default" => true
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "library_books",
                        "text" => "Заказанные справки",
                        "component" => null,
                        "children"=>[]
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обратная связь",
                        "component" => null,
                        "default" => true
                    ]
                ]),
            ],
            [
                "name" => "Ограниченный функционал",
                "slug" => "nullfunc",
                "privilegies" => json_encode([
                    [
                        "id" => 1,
                        "icon" => "home",
                        "text" => "Главная",
                        "component" => [
                            "info" => [
                                "name" => "Домашняя страница",
                                "url" => ""
                            ],
                            "path" => "@/js/views/homes-f/Home"
                        ],
                        "default" => true
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обратная связь",
                        "component" => null,
                        "default" => true
                    ]
                ]),
            ],
            [
                "name" => "Редактор новостей",
                "slug" => "editor",
                "privilegies" => json_encode([
                    [
                        "id" => 1,
                        "icon" => "home",
                        "text" => "Главная",
                        "component" => [
                            "info" => [
                                "name" => "Домашняя страница",
                                "url" => ""
                            ],
                            "path" => "@/js/views/homes-f/Home"
                        ],
                        "default" => true
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "whatshot",
                        "text" => "Новости",
                        "component" => null,
                        "default" => true,
                        "children"=>[]
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "create",
                        "text" => "Создать новость",
                        "component" => null,
                        "default" => true,
                        "children"=>[]
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "bar_chart",
                        "text" => "Статистика",
                        "component" => null,
                        "children"=>[]
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обратная связь",
                        "component" => null,
                        "default" => true
                    ],
                ]),
            ]
        );
        DB::table("users_posts")->insert($date);
    }
}
