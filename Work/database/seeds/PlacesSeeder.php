<?php

use Illuminate\Database\Seeder;

class PlacesSeeder extends Seeder
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
                'place_name' => "Нахимовский проспект"
            ],
            [
                'place_name' => "Неженская улица"
            ]
        );
        DB::table("places")->insert($data);
    }
}
