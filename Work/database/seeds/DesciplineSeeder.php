<?php

use Illuminate\Database\Seeder;

class DesciplineSeeder extends Seeder
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
                "discipline_name"=>"Технология разработки и защиты баз данных",
            ],
            [
                "discipline_name"=>"Инфокумуникационные системы и сети",
            ],
            [
                "discipline_name"=>"Иностранный язык",
            ],
            [
                "discipline_name"=>"Физическая культура",
            ],
            [
                "discipline_name"=>"Прикладное программирование",
            ],
            [
                "discipline_name"=>"Теория разработки программного обеспечения",
            ],
        );
        DB::table("disciplines")->insert($date);
    }
}
