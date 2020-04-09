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
                            "path" => "js/views/homes-f/AdminHome"
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
                                    "path" => "js/views/administrator-f/PanelControl"
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
                                        "name" => "Учебное расписание",
                                        "url"=> "timetableRoot"
                                    ],
                                    "path" => "js/views/timetable-f/TimetableRoot"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Изменения в расписании",
                                "component" => [
                                    "info" => [
                                        "name" => "Замены расписания",
                                        "url"=> "replacementsRoot"
                                    ],
                                    "path" => "js/views/replacements-f/ReplacementsRoot"
                                ],

                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Расписание звонков",
                                "component" => [
                                    "info" => [
                                        "name" => "Расписание звонков",
                                        "url"=> "bild_call_schedule"
                                    ],
                                    "path" => "js/views/call-schedule-f/Bild_CallSchedule"
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
                                    "path" => "js/views/administrator-f/CRUD/CRUDUser"
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
                                    "path" => "js/views/administrator-f/CRUD/CRUDPost"
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
                                    "path" => "js/views/administrator-f/CRUD/CRUDDepartment"
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
                                    "path" => "js/views/administrator-f/CRUD/CRUDGroup"
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
                                    "path" => "js/views/administrator-f/CRUD/CRUDPlace"
                                 ],
                            ]
                        ],

                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обращение пользователей",
                        "component" => [
                            "info" => [
                                "name" => "Просмотр обращений пользователей",
                                "url"=> "requests"
                            ],
                            "path" => "js/views/feedback-f/Request"
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
                            "path" => "js/views/homes-f/DefaultHome"
                        ],
                        "default" => true
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "portrait",
                        "text" => "Мой профиль",
                        "component" => [
                            "info" => [
                                "name" => "Мой профиль",
                                "url"=> "profile"
                            ],
                            "path" => "js/views/account-card-f/AccountCard"
                        ],  
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "whatshot",
                        "text" => "Новости",
                        "component" => [
                            "info" => [
                                "name" => "Лента новостей",
                                "url"=> "news"
                            ],
                            "path" => "js/views/news-f/NewsFeed"
                        ],   
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "school",
                        "text" => "Учебные процесс",
                        "children" => [
                            [
                                "id" => uniqid(),
                                "text" => "Расписание занятий",
                                "component" => [
                                    "info" => [
                                        "name" => "Расписание занятий",
                                        "url"=> "timetable"
                                    ],
                                    "path" => "js/views/timetable-f/Timetable"
                                ], 
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Изменения в расписании",
                                "component" => [
                                    "info" => [
                                        "name" => "Изменения в расписании",
                                        "url"=> "replacements"
                                    ],
                                    "path" => "js/views/replacements-f/Replacements"
                                ], 
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Расписание экзаменов",
                                "component" => [
                                    "info" => [
                                        "name" => "Расписание экзаменов",
                                        "url"=> "exams"
                                    ],
                                    "path" => "js/views/other-f/Warning"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Успеваемость",
                                "component" => [
                                    "info" => [
                                        "name" => "Успеваемость",
                                        "url"=> "progress"
                                    ],
                                    "path" => "js/views/other-f/Warning"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Домашнее задание",
                                "component" => [
                                    "info" => [
                                        "name" => "Домашнее задание",
                                        "url"=> "homework"
                                    ],
                                    "path" => "js/views/other-f/Warning"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Преподаватели",
                                "component" => [
                                    "info" => [
                                        "name" => "Преподаватели",
                                        "url"=> "teachers"
                                    ],
                                    "path" => "js/views/other-f/Warning"
                                ],
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
                                "component" => [
                                    "info" => [
                                        "name" => "Справки и характеристики",
                                        "url"=> "certificate"
                                    ],
                                    "path" => "js/views/certificate-f/TabCertificate"
                                ], 
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Психолог",
                                "component" => [
                                    "info" => [
                                        "name" => "warning",
                                        "url"=> "psych"
                                    ],
                                    "path" => "js/views/other-f/Warning"
                                ],
                            ]
                        ],
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "cloud",
                        "text" => "Хранилище данных",
                        "component" => [
                            "info" => [
                                "name" => "Хранилище данных",
                                "url"=> "datastorage"
                            ],
                            "path" => "js/views/other-f/Warning"
                        ],  
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обратная связь",
                        "component" => [
                            "info" => [
                                "name" => "Обратная связь",
                                "url"=> "feedback"
                            ],
                            "path" => "js/views/feedback-f/Feedback"
                        ], 
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
                            "path" => "js/views/homes-f/DefaultHome"
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
                                "text" => "Расписание занятий",
                                "component" => [
                                    "info" => [
                                        "name" => "Расписание занятий",
                                        "url"=> "timetable"
                                    ],
                                    "path" => "js/views/timetable-f/Timetable"
                                ], 
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Изменения в расписании",
                                "component" => [
                                    "info" => [
                                        "name" => "Изменения в расписании",
                                        "url"=> "replacements"
                                    ],
                                    "path" => "js/views/replacements-f/Replacements"
                                ], 
                            ],
                        ],
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "class",
                        "text" => "Учебные журналы",
                        "component" => [
                            "info" => [
                                "name" => "Учебные журналы",
                                "url"=> "journals"
                            ],
                            "path" => "js/views/other-f/Warning"
                        ],   
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обратная связь",
                        "component" => [
                            "info" => [
                                "name" => "Обратная связь",
                                "url"=> "feedback"
                            ],
                            "path" => "js/views/feedback-f/Feedback"
                        ], 
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
                            "path" => "js/views/homes-f/DefaultHome"
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
                                "text" => "Учебное расписание",
                                "component" => [
                                    "info" => [
                                        "name" => "Учебное расписание",
                                        "url"=> "timetableRoot"
                                    ],
                                    "path" => "js/views/timetable-f/TimetableRoot"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Изменения в расписании",
                                "component" => [
                                    "info" => [
                                        "name" => "Замены расписания",
                                        "url"=> "replacementsRoot"
                                    ],
                                    "path" => "js/views/replacements-f/ReplacementsRoot"
                                ],

                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Расписание звонков",
                                "component" => [
                                    "info" => [
                                        "name" => "Расписание звонков",
                                        "url"=> "bild_call_schedule"
                                    ],
                                    "path" => "js/views/call-schedule-f/Bild_CallSchedule"
                                 ],
                            ]
                        ],
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обратная связь",
                        "component" => [
                            "info" => [
                                "name" => "Обратная связь",
                                "url"=> "feedback"
                            ],
                            "path" => "js/views/feedback-f/Feedback"
                        ], 
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
                            "path" => "js/views/homes-f/DefaultHome"
                        ],
                        "default" => true
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "library_books",
                        "text" => "list_certificate",
                        "component" => [
                            "info" => [
                                "name" => "Просмотр заказанных справок",
                                "url"=> "listcertificate"
                            ],
                            "path" => "js/views/certificate-f/ListCertificateComponent"
                        ],   
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обратная связь",
                        "component" => [
                            "info" => [
                                "name" => "Обратная связь",
                                "url"=> "feedback"
                            ],
                            "path" => "js/views/feedback-f/Feedback"
                        ], 
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
                            "path" => "js/views/homes-f/DefaultHome"
                        ],
                        "default" => true
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обратная связь",
                        "component" => [
                            "info" => [
                                "name" => "Обратная связь",
                                "url"=> "feedback"
                            ],
                            "path" => "js/views/feedback-f/Feedback"
                        ], 
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
                            "path" => "js/views/homes-f/DefaultHome"
                        ],
                        "default" => true
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "whatshot",
                        "text" => "Новости",
                        "component" => [
                            "info" => [
                                "name" => "Лента новостей",
                                "url"=> "news"
                            ],
                            "path" => "js/views/news-f/NewsFeed"
                        ],   
                        "children"=>[], 
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "create",
                        "text" => "Создать новость",
                        "component" => [
                            "info" => [
                                "name" => "Создать новость",
                                "url"=> "news-constructor"
                            ],
                            "path" => "js/views/other-f/Warning"
                        ],
                        "children"=>[],
                        "default" => true
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "bar_chart",
                        "text" => "Статистика",
                        "component" => [
                            "info" => [
                                "name" => "Статистика",
                                "url"=> "news-statistics"
                            ],
                            "path" => "js/views/other-f/Warning"
                        ],
                        "children"=>[],
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обратная связь",
                        "component" => [
                            "info" => [
                                "name" => "Обратная связь",
                                "url"=> "feedback"
                            ],
                            "path" => "js/views/feedback-f/Feedback"
                        ], 
                        "default" => true
                    ],
                ]),
            ]
        );
        DB::table("users_posts")->insert($date);
    }
}