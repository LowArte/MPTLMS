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
            UsersSeeder::class,
            RetrainingInfoSeeder::class,
            SiteOptionsSeeder::class,
            PlacesSeeder::class,
            CallSchedulesSeeder::class,
            DepartamentSeeder::class,
            GroupSeeder::class,
            GroupSeeder2::class,
            ScheduleSeeder::class,
            SwapScheduleSeeder::class,
            DesciplineSeeder::class
        ]);
        
        $this->call([
            TeachersSeeder::class,
            StudentsSeeder::class
        ]);
    }
}