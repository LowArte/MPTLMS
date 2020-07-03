<?php

use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
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
                "type"=>"Справка",
                "certificates_data"=>json_encode(['Текст'=> 'Хочу справку!']),
                "done"=>rand(0,1)
            ],
        );
        DB::table("certificates")->insert($data);
    }
}
