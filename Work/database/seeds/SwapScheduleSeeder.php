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
            "swap_date"=>new DateTime(),
            "schedule_id"=>1,
            "swap"=>json_encode(array(

            ))
        ];
        DB::table("schedule_swaps")->insert($data);
    }
}
