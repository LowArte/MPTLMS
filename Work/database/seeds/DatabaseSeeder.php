<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder  extends Seeder
{
    /**
     * Запуск seeders для заполнения базы данных предварительными данными.
     *
     * @return void
     */
    public function run()
    {
        //Формирование пользователей системы
        $this->call([
            PostUserSeeder::class,
            UsersSeeder::class,
            NotificationsSeeder::class,
        ]);
        //Формирование вспомогательных данных
        $this->call([
            SiteOptionsSeeder::class,
            DesciplineSeeder::class,
        ]);
        //Формирование мест проведения занятий и расписания звонков
        $this->call([
            PlacesSeeder::class,
            CallSchedulesSeeder::class,
        ]);
        //Формирование отделений и групп
        $this->call([
            DepartmentSeeder::class,
            GroupSeeder::class,
            GroupSeederExtention::class,
        ]);
        //Формирование данный для особых пользователей
        $this->call([
            TeachersSeeder::class,
            StudentsSeeder::class
        ]);
        //Формирование расписаний и замен
        $this->call([           
            ScheduleSeeder::class,
            SwapScheduleSeeder::class,
        ]);
        //Формирование тестовых данных обратной связи и заказа документов
        $this->call([           
            FeedbackSeeder::class,
            CertificateSeeder::class,
        ]);
    }
}