<?php

use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array();
        for($i = 0; $i < 10; $i++)
        array_push(
            $data,
            [
                "user_id"=>2,
                "type"=>"Другое",
                "text"=>"Сообщение",
                "answered"=>rand(0,1)
            ],
        );
        DB::table("feedback")->insert($data);
    }
}
