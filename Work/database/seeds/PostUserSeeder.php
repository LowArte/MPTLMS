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
                        "default" => true,

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
                                        "url" => "server_settings"
                                    ],
                                    "path" => "js/views/administrator-f/PanelControl"
                                ],
                                "default" => true,
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "История системы",
                                "component" => [
                                    "info" => [
                                        "name" => "История системы",
                                        "url" => "history"
                                    ],
                                    "path" => "js/views/history-f/History"
                                ],
                                "default" => true,
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
                                        "url" => "timetable",
                                    ],
                                    "dop_com" => [
                                        [
                                            "url" => "bild_timetable",
                                            "path" => "js/views/timetable-f/Bild_Timetable"
                                        ]
                                    ],
                                    "path" => "js/views/timetable-f/Timetable"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Изменения в расписании",

                                "component" => [
                                    "info" => [
                                        "name" => "Замены расписания",
                                        "url" => "replacements",
                                    ],
                                    "dop_com" => [
                                        [
                                            "url" => "bild_replacements",
                                            "path" => "js/views/replacements-f/Bild_Replacements"
                                        ]
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
                                        "url" => "timetable_exam"
                                    ],
                                    "path" => "js/views/timetable-exam-f/Timetable_Exam"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Аудиторный фонд",

                                "component" => [
                                    "info" => [
                                        "name" => "Аудиторный фонд",
                                        "url" => "bild_classroom_fund"
                                    ],
                                    "path" => "js/views/сlassroom-foundation-f/Bild_Classroom_Foundation"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Расписание звонков",

                                "component" => [
                                    "info" => [
                                        "name" => "Расписание звонков",
                                        "url" => "bild_call_schedule"
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
                                "text" => "Менеджер дисциплин",
                                "component" => [
                                    "info" => [
                                        "name" => "Менеджер дисциплин",
                                        "url" => "discipline_managment",
                                    ],
                                    "dop_com" => [
                                        [
                                            "url" => "disciplines_crud/:dbName",
                                            "path" => "js/views/administrator-f/CRUD/CRUDDiscipline"
                                        ]
                                    ],
                                    "path" => "js/views/administrator-f/DisciplineManagment"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Пользователи",

                                "component" => [
                                    "info" => [
                                        "name" => "CRUD пользователей",
                                        "url" => "users_crud"
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
                                        "url" => "posts_crud"
                                    ],
                                    "path" => "js/views/administrator-f/CRUD/CRUDPost"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Привилегии ролей",

                                "component" => [
                                    "info" => [
                                        "name" => "Конструктор привилегий ролей",
                                        "url" => "bild_post_privilegies"
                                    ],
                                    "path" => "js/views/posts-f/Bild_RolesPrivilegies"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Отделения",

                                "component" => [
                                    "info" => [
                                        "name" => "CRUD отделений",
                                        "url" => "departments_crud"
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
                                        "url" => "groups_crud"
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
                                        "url" => "places_crud"
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
                                "url" => "requests"
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
                        "default" => true,
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "portrait",
                        "text" => "Мой профиль",

                        "component" => [
                            "info" => [
                                "name" => "Мой профиль",
                                "url" => "profile"
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
                                "url" => "news"
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
                                        "url" => "timetable",
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
                                        "url" => "replacements"
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
                                        "url" => "timetable_exam"
                                    ],
                                    "path" => "js/views/timetable-exam-f/Timetable_Exam"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Успеваемость",
                                "component" => [
                                    "info" => [
                                        "name" => "Успеваемость",
                                        "url" => "journal"
                                    ],
                                    "path" => "js/views/journal-f/JournalStudent"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Домашнее задание",

                                "component" => [
                                    "info" => [
                                        "name" => "Домашнее задание",
                                        "url" => "homework"
                                    ],
                                    "path" => "js/views/homework-f/HomeWork"
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
                                "text" => "Заказ документов",

                                "component" => [
                                    "info" => [
                                        "name" => "Заказ справок",
                                        "url" => "certificate"
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
                                        "url" => "psychologicalcounseling"
                                    ],
                                    "path" => "js/views/psychological-counseling-f/Psychological_Counseling"
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
                                "url" => "feedback"
                            ],
                            "path" => "js/views/feedback-f/Feedback"
                        ],
                        "default" => true,
                    ]
                ])
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
                        "default" => true,
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
                                        "url" => "timetable",
                                    ],
                                    "path" => "js/views/timetable-f/Timetable"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Расписание преподавателя",
                                "component" => [
                                    "info" => [
                                        "name" => "Расписание",
                                        "url" => "timetable_teacher"
                                    ],
                                    "path" => "js/views/timetable-f/Timetable_Teacher"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Изменения в расписании",

                                "component" => [
                                    "info" => [
                                        "name" => "Изменения в расписании",
                                        "url" => "replacements"
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
                                        "url" => "timetable-exam"
                                    ],
                                    "path" => "js/views/timetable-exam-f/Timetable_Exam"
                                ],
                            ],
                        ],
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "class",
                        "text" => "Учебные журналы",
                        "children" => [
                            [
                                "id" => uniqid(),
                                "text" => "Журналы групп",
                                "component" => [
                                    "info" => [
                                        "name" => "Успеваемость",
                                        "url" => "journal",
                                    ],
                                    "dop_com" => [
                                        [
                                            "url" => "group_journal/:journal_id",
                                            "path" => "js/views/journal-f/Journal"
                                        ]
                                    ],
                                    "path" => "js/views/journal-f/JournalTeacher"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Домашнее задание",
                                "component" => [
                                    "info" => [
                                        "name" => "Домашнее задание",
                                        "url" => "homework_teacher"
                                    ],
                                    "path" => "js/views/homework-f/HomeWorkTeacher"
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
                                "url" => "feedback"
                            ],
                            "path" => "js/views/feedback-f/Feedback"
                        ],
                        "default" => true,
                    ]
                ])
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
                        "default" => true,
                    ],
                    [
                        "id" => uniqid(),
                        "text" => "Менеджер дисциплин",
                        "icon" => "sd_storage",
                        "component" => [
                            "info" => [
                                "name" => "Менеджер дисциплин",
                                "url" => "discipline_managment",
                            ],
                            "dop_com" => [
                                [
                                    "url" => "disciplines_crud/:dbName",
                                    "path" => "js/views/administrator-f/CRUD/CRUDDiscipline"
                                ]
                            ],
                            "path" => "js/views/administrator-f/DisciplineManagment"
                        ],
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
                                        "url" => "timetable",
                                    ],
                                    "dop_com" => [
                                        [
                                            "url" => "bild_timetable",
                                            "path" => "js/views/timetable-f/Bild_Timetable"
                                        ]
                                    ],
                                    "path" => "js/views/timetable-f/Timetable"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Изменения в расписании",

                                "component" => [
                                    "info" => [
                                        "name" => "Замены расписания",
                                        "url" => "replacements",
                                    ],
                                    "dop_com" => [
                                        [
                                            "url" => "bild_replacements",
                                            "path" => "js/views/replacements-f/Bild_Replacements"
                                        ]
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
                                        "url" => "timetable-exam"
                                    ],
                                    "path" => "js/views/timetable-exam-f/Timetable_Exam"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Аудиторный фонд",

                                "component" => [
                                    "info" => [
                                        "name" => "Аудиторный фонд",
                                        "url" => "bild-classroom-foundation"
                                    ],
                                    "path" => "js/views/сlassroom-foundation-f/Bild_Classroom_Foundation"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Расписание звонков",

                                "component" => [
                                    "info" => [
                                        "name" => "Расписание звонков",
                                        "url" => "bild_call_schedule"
                                    ],
                                    "path" => "js/views/call-schedule-f/Bild_CallSchedule"
                                ],
                            ]
                        ],
                    ],
                    [
                        "id" => uniqid(),
                        "text" => "Учебные журналы",
                        "component" => [
                            "info" => [
                                "name" => "Журнал учебной части",
                                "url" => "journal_unit"
                            ],
                            "dop_com" => [
                                [
                                    "url" => "journal/:group_id",
                                    "path" => "js/views/journal-f/JournalOfSubjects"
                                ],
                                [
                                    "url" => "group_journal/:journal_id",
                                    "path" => "js/views/journal-f/Journal"
                                ]
                            ],
                            "path" => "js/views/journal-f/JournalUnit"
                        ],
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обратная связь",

                        "component" => [
                            "info" => [
                                "name" => "Обратная связь",
                                "url" => "feedback"
                            ],
                            "path" => "js/views/feedback-f/Feedback"
                        ],
                        "default" => true,
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
                        "default" => true,
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "library_books",
                        "text" => "Заказанные справки",

                        "component" => [
                            "info" => [
                                "name" => "Заказанные справки",
                                "url" => "listcertificate"
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
                                "url" => "feedback"
                            ],
                            "path" => "js/views/feedback-f/Feedback"
                        ],
                        "default" => true,
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
                        "default" => true,
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обратная связь",

                        "component" => [
                            "info" => [
                                "name" => "Обратная связь",
                                "url" => "feedback"
                            ],
                            "path" => "js/views/feedback-f/Feedback"
                        ],
                        "default" => true,
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
                        "default" => true,
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "dashboard",
                        "text" => "Панель управления",

                        "component" => [
                            "info" => [
                                "name" => "Панель управления",
                                "url" => "editor_panel"
                            ],
                            "path" => "js/views/homes-f/EditorHome"
                        ],
                        "default" => true,
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "whatshot",
                        "text" => "Новости",

                        "component" => [
                            "info" => [
                                "name" => "Лента новостей",
                                "url" => "news"
                            ],
                            "path" => "js/views/news-f/NewsFeed"
                        ]
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "create",
                        "text" => "Создать новость",

                        "component" => [
                            "info" => [
                                "name" => "Создать новость",
                                "url" => "news-constructor"
                            ],
                            "path" => "js/views/news-f/NewsConstructor"
                        ],
                        "default" => true
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "bar_chart",
                        "text" => "Статистика",

                        "component" => [
                            "info" => [
                                "name" => "Статистика",
                                "url" => "news-statistics"
                            ],
                            "path" => "js/views/news-f/NewsStatistics"
                        ]
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обратная связь",

                        "component" => [
                            "info" => [
                                "name" => "Обратная связь",
                                "url" => "feedback"
                            ],
                            "path" => "js/views/feedback-f/Feedback"
                        ],
                        "default" => true,
                    ],
                ]),
            ]
        );
        DB::table("users_posts")->insert($date);
    }
}
