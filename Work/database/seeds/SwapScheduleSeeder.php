<?php

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\User;

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
        $schedule = Schedule::get();
        $teachers = User::where("post_id", 3)->get();
        $data = array();
        for ($i = 0; $i < count($schedule); $i++)
            array_push(
                $data,
                [
                    "swap_date" => new DateTime(),
                    "schedule_id" => $schedule[$i]->id,
                    "swap" =>  json_encode(array(
                        "caselesson" => "1",
                        "lesson" => [rand(1,20)],
                        "teacher" => [$teachers[rand(0, count($teachers)-1)]->id],
                        "oldlesson" => [rand(1,20)],
                        "oldteacher" => [$teachers[rand(0, count($teachers)-1)]->id]
                    )),
                    "created_at" => "2020-02-22 00:00:00"
                ]         
            );
        DB::table("schedule_swaps")->insert($data);
    }
}
