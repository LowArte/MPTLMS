<?php

use Illuminate\Database\Seeder;

class CallSchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                'place_id' => "1",
                'call_schedule' => json_encode([
                    "1" => "08:30-10:00",
                    "2" => "10:10-11:40",
                    "3" => "12:00-13:30",
                    "4" => "14:00-15:30",
                    "5" => "15:40-17:10",
                    "6" => "17:20-18:50",
                    "7" => "19:00-20:30",
                ])

            ],
            [
                'place_id' => "2",
                'call_schedule' => json_encode([
                    "1" => "08:30-10:00",
                    "2" => "10:10-11:40",
                    "3" => "12:00-13:30",
                    "4" => "14:00-15:30",
                    "5" => "15:40-17:10",
                    "6" => "17:20-18:50",
                    "7" => "19:00-20:30",
                ])
            ]
        );
        DB::table("call_schedules")->insert($data);
    }
}
