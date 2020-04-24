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
            DepartmentSeeder::class,
            GroupSeeder::class,
            GroupSeeder2::class,
            ScheduleSeeder::class,
            SwapScheduleSeeder::class,
            DesciplineSeeder::class,
            FeedbackSeeder::class,
            CertificateSeeder::class,
        ]);
        
        $this->call([
            TeachersSeeder::class,
            StudentsSeeder::class
        ]);
    }
}