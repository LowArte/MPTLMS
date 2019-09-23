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
            PostUsersSeeder::class
        ]);
        factory(\App\Models\Users::class ,100)->create();
    }
}
