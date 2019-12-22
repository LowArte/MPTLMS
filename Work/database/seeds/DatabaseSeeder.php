<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            PostUserSeeder::class,
            DepartamentSeeder::class,
            GroupSeeder::class,
            ScheduleSeeder::class,
            PlacesSeeder::class,
            CallSchedulesSeeder::class,
            DesciplineSeeder::class,
            SiteOptionsSeeder::class,
            SwapScheduleSeeder::class,
            RetrainingInfoSeeder::class,
            TestUserSeeder::class, //Подлежит удалению
        ]);
        factory(\App\User::class, 100)->create();
        
        $this->call([
            TeachersSeeder::class,
            StudentsSeeder::class
        ]);
    }
}
