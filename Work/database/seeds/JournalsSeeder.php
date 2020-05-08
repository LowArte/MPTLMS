<?php

use App\Models\Association;
use Illuminate\Database\Seeder;

class JournalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $associations = Association::get();
        $data = [];
        foreach ($associations as $association) 
        {
           array_push($data,[
            'association_id' => $association['id'],
            'isClose' => false,
            'titles' => json_encode([]),
            'journal' => json_encode([])     
           ]);
        }

        DB::table("journals")->insert($data);
    }
}