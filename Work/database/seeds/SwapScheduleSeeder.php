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
                "caselesson" => "1",
                "schedule_new" => array(
                    "Lesson" => "1",
                    "Teacher" => "1"
                ),
                "schedule_old" => array(
                    "Lesson" => "2",
                    "Teacher" => "1"
                )
            ))
        ];
        DB::table("schedule_swaps")->insert($data);
    }
}
