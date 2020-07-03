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
                'place_name' => "Нахимовский проспект",
                'info' => json_encode([
                    "place_index" => "",
                    "place_country" => "",
                    "place_city" => "",
                    "place_street" => "",
                    "place_building_number" => "",
                    "place_piy" => "",
                ])
            ],
            [
                'place_name' => "Неженская улица",
                'info' => json_encode([
                    "place_index" => "",
                    "place_country" => "",
                    "place_city" => "",
                    "place_street" => "",
                    "place_building_number" => "",
                    "place_piy" => "",
                ])
            ]
        );
        DB::table("places")->insert($data);
    }
}
