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
                "lesson" => [1],
                "teacher" => [1],
                "oldlesson" => [1],
                "oldteacher" => [1]
            )),
            "created_at" => "2020-02-22 09:49:48"            
        ];
        DB::table("schedule_swaps")->insert($data);
    }
}
