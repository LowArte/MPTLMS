<?php

use Illuminate\Database\Seeder;

class RetrainingInfoSeeder extends Seeder
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
                "href"=>"Технология разработки и защиты баз данных",
                "title"=>"Технология разработки и защиты баз данных",
                "cost"=>"Технология разработки и защиты баз данных",
                "time"=>"Технология разработки и защиты баз данных",
                "text"=>"Технология разработки и защиты баз данных",
            ],
           
        );
        DB::table("retraining_infos")->insert($date);
    }
}
