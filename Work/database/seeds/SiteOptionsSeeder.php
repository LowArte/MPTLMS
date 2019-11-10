<?php

use Illuminate\Database\Seeder;

class SiteOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = array(
            [
                "option_name"=>"isProfilacticServer",
                "option_value"=>false
            ],
        );
        DB::table("site_options")->insert($date);
    }
}
