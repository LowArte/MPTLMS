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
                        "menu" => true,

                    ],
                    [
                        "id" => uniqid(),
                        "text" => "Конструктор учебного расписания",
                        "component" => [
                            "info" => [
                                "name" => "Конструктор учебного расписания",
                                "url" => "bild_timetable"
                            ],
                            "path" => "js/views/timetable-f/Bild_Timetable"
                        ],
                        "default" => true,
                        "menu" => false,
                    ],
                    [
                        "id" => uniqid(),
                        "text" => "Конструктор замен расписания",
                        "component" => [
                            "info" => [
                                "name" => "Конструктор замен расписания",
                                "url" => "bild_replacements"
                            ],
                            "path" => "js/views/replacements-f/Bild_Replacements"
                        ],
                        "default" => true,
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "settings_brightness",
                        "text" => "Панель управления",
                        "default" => true,
                        "menu" => true,
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
                                "menu" => true,
                            ]
                        ]
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "assignment",
                        "text" => "Расписания",
                        "menu" => true,
                        "children" => [
                            [
                                "id" => uniqid(),
                                "text" => "Учебное расписание",
                                "menu" => true,
                                "component" => [
                                    "info" => [
                                        "name" => "Учебное расписание",
                                        "url" => "timetable"
                                    ],
                                    "path" => "js/views/timetable-f/Timetable"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Изменения в расписании",
                                "menu" => true,
                                "component" => [
                                    "info" => [
                                        "name" => "Замены расписания",
                                        "url" => "replacements"
                                    ],
                                    "path" => "js/views/replacements-f/Replacements"
                                ],

                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Расписание экзаменов",
                                "menu" => true,
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
                                "menu" => true,
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
                                "menu" => true,
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
                        "text" => "Уведомления",
                        "component" => [
                            "info" => [
                                "name" => "Уведомления",
                                "url" => "notifications"
                            ],
                            "path" => "js/views/notifications-f/NotificationsPage"
                        ],
                        "default" => true,
                        "menu" => false,
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "sd_storage",
                        "text" => "База данных",
                        "menu" => true,
                        "children" => [
                            [
                                "id" => uniqid(),
                                "text" => "Пользователи",
                                "menu" => true,
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
                                "menu" => true,
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
                                "menu" => true,
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
                                "menu" => true,
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
                                "menu" => true,
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
                                "menu" => true,
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
                        "menu" => true,
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
                        "menu" => true,
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
                        "text" => "Уведомления",
                        "component" => [
                            "info" => [
                                "name" => "Уведомления",
                                "url" => "notifications"
                            ],
                            "path" => "js/views/notifications-f/NotificationsPage"
                        ],
                        "default" => true,
                        "menu" => false,
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "portrait",
                        "text" => "Мой профиль",
                        "menu" => true,
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
                        "menu" => true,
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
                        "menu" => true,
                        "children" => [
                            [
                                "id" => uniqid(),
                                "text" => "Расписание занятий",
                                "menu" => true,
                                "component" => [
                                    "info" => [
                                        "name" => "Расписание занятий",
                                        "url" => "timetable"
                                    ],
                                    "path" => "js/views/timetable-f/Timetable"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Изменения в расписании",
                                "menu" => true,
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
                                "menu" => true,
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
                                "menu" => true,
                                "component" => [
                                    "info" => [
                                        "name" => "Успеваемость",
                                        "url" => "progress"
                                    ],
                                    "path" => "js/views/journal-f/Journal"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Домашнее задание",
                                "menu" => true,
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
                        "menu" => true,
                        "children" => [
                            [
                                "id" => uniqid(),
                                "text" => "Заказ документов",
                                "menu" => true,
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
                                "menu" => true,
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
                        "menu" => true,
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
                "name" => "Преподаватель",
                "slug" => "teacher",
                "privilegies" => json_encode([
                    [
                        "id" => 1,
                        "icon" => "home",
                        "text" => "Главная",
                        "menu" => true,
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
                        "text" => "Уведомления",
                        "component" => [
                            "info" => [
                                "name" => "Уведомления",
                                "url" => "notifications"
                            ],
                            "path" => "js/views/notifications-f/NotificationsPage"
                        ],
                        "default" => true,
                        "menu" => false,
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "school",
                        "text" => "Учебные процесс",
                        "menu" => true,
                        "children" => [
                            [
                                "id" => uniqid(),
                                "text" => "Расписание занятий",
                                "menu" => true,
                                "component" => [
                                    "info" => [
                                        "name" => "Расписание занятий",
                                        "url" => "timetable"
                                    ],
                                    "path" => "js/views/timetable-f/Timetable"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Расписание преподавателя",
                                "menu" => true,
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
                                "menu" => true,
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
                                "menu" => true,
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
                        "menu" => true,
                        "children" => [
                            [
                                "id" => uniqid(),
                                "text" => "Журналы групп",
                                "menu" => true,
                                "component" => [
                                    "info" => [
                                        "name" => "Успеваемость",
                                        "url" => "progress"
                                    ],
                                    "path" => "js/views/journal-f/JournalTeacher"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Домашнее задание",
                                "menu" => true,
                                "component" => [
                                    "info" => [
                                        "name" => "Домашнее задание",
                                        "url" => "homework_teacher"
                                    ],
                                    "path" => "js/views/homework-f/HomeWorkTeacher"
                                ],
                            ]
                        ]
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обратная связь",
                        "menu" => true,
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
                "name" => "Учебная часть",
                "slug" => "unit",
                "privilegies" => json_encode([
                    [
                        "id" => 1,
                        "icon" => "home",
                        "text" => "Главная",
                        "menu" => true,
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
                        "text" => "Уведомления",
                        "component" => [
                            "info" => [
                                "name" => "Уведомления",
                                "url" => "notifications"
                            ],
                            "path" => "js/views/notifications-f/NotificationsPage"
                        ],
                        "default" => true,
                        "menu" => false,
                    ],
                    [
                        "id" => uniqid(),
                        "text" => "Журналы по дисциплинам",
                        "component" => [
                            "info" => [
                                "name" => "Журналы по дисциплинам",
                                "url" => "journal/subjects"
                            ],
                            "path" => "js/views/journal-f/JournalOfSubjects"
                        ],
                        "default" => true,
                        "menu" => false,
                    ],
                    [
                        "id" => uniqid(),
                        "text" => "Журнал по дисциплине",
                        "component" => [
                            "info" => [
                                "name" => "Журнал по дисциплине",
                                "url" => "journal/subject"
                            ],
                            "path" => "js/views/journal-f/Journal"
                        ],
                        "default" => true,
                        "menu" => false,
                    ],
                    [
                        "id" => uniqid(),
                        "text" => "Конструктор учебного расписания",
                        "component" => [
                            "info" => [
                                "name" => "Конструктор учебного расписания",
                                "url" => "bild_timetable"
                            ],
                            "path" => "js/views/timetable-f/Bild_Timetable"
                        ],
                        "default" => true,
                        "menu" => false
                    ],
                    [
                        "id" => uniqid(),
                        "text" => "Конструктор замен расписания",
                        "component" => [
                            "info" => [
                                "name" => "Конструктор замен расписания",
                                "url" => "bild_replacements"
                            ],
                            "path" => "js/views/replacements-f/Bild_Replacements"
                        ],
                        "default" => true,
                        "menu" => false
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "assignment",
                        "text" => "Расписания",
                        "menu" => true,
                        "children" => [
                            [
                                "id" => uniqid(),
                                "text" => "Учебное расписание",
                                "menu" => true,
                                "component" => [
                                    "info" => [
                                        "name" => "Учебное расписание",
                                        "url" => "timetable"
                                    ],
                                    "path" => "js/views/timetable-f/Timetable"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Изменения в расписании",
                                "menu" => true,
                                "component" => [
                                    "info" => [
                                        "name" => "Замены расписания",
                                        "url" => "replacements"
                                    ],
                                    "path" => "js/views/replacements-f/Replacements"
                                ],

                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Расписание экзаменов",
                                "menu" => true,
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
                                "menu" => true,
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
                                "menu" => true,
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
                        "icon" => "class",
                        "text" => "Успеваемость",
                        "menu" => true,
                        "children" => [
                            [
                                "id" => uniqid(),
                                "text" => "Учебные журналы",
                                "menu" => true,
                                "component" => [
                                    "info" => [
                                        "name" => "Успеваемость",
                                        "url" => "journals"
                                    ],
                                    "path" => "js/views/journal-f/JournalUnit"
                                ],
                            ],
                            [
                                "id" => uniqid(),
                                "text" => "Домашнее задание",
                                "menu" => true,
                                "component" => [
                                    "info" => [
                                        "name" => "Домашнее задание",
                                        "url" => "homework_teacher"
                                    ],
                                    "path" => "js/views/homework-f/HomeWorkTeacher"
                                ],
                            ]
                        ]
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "feedback",
                        "text" => "Обратная связь",
                        "menu" => true,
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
                        "menu" => true,
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
                        "text" => "Уведомления",
                        "component" => [
                            "info" => [
                                "name" => "Уведомления",
                                "url" => "notifications"
                            ],
                            "path" => "js/views/notifications-f/NotificationsPage"
                        ],
                        "default" => true,
                        "menu" => false,
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "library_books",
                        "text" => "Заказанные справки",
                        "menu" => true,
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
                        "menu" => true,
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
                        "menu" => true,
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
                        "menu" => true,
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
                        "menu" => true,
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
                        "menu" => true,
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
                        "text" => "Уведомления",
                        "component" => [
                            "info" => [
                                "name" => "Уведомления",
                                "url" => "notifications"
                            ],
                            "path" => "js/views/notifications-f/NotificationsPage"
                        ],
                        "default" => true,
                        "menu" => false,
                    ],
                    [
                        "id" => uniqid(),
                        "icon" => "whatshot",
                        "text" => "Новости",
                        "menu" => true,
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
                        "menu" => true,
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
                        "menu" => true,
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
                        "menu" => true,
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