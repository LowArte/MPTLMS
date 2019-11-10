<?php

use Illuminate\Database\Seeder;

use function GuzzleHttp\json_encode;

class SwapScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "swap_date" => new DateTime(),
            "schedule_id" => 1,
            "swap" =>  json_encode(array(
                "schedyle_number" => "1",
                "schedule_new" => array(
                    "Lesson" => "",
                    "Teacher" => ""
                ),
                "schedule_old" => array(
                    "Lesson" => "",
                    "Teacher" => ""
                )
            ))
        ];
        DB::table("schedule_swaps")->insert($data);
    }
}
