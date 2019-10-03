<?php

use App\Models\Group;
use App\Schedule;
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
            PostUsersSeeder::class,
            DepartamentsSeeder::class,
            GroupsSeeder::class,
            ScheduleSeeder::class
        ]);
        factory(\App\Models\Users::class ,100)->create();
        factory(\App\Models\Student::class ,100)->create();
    }
}
