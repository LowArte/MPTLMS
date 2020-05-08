<?php

use App\Models\Group;
use Illuminate\Database\Seeder;

class AssociationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = Group::get();
        $data = [];
        foreach ($groups as $group) 
        {
           array_push($data,[
            'teacher_id' => 1,
            'group_id' => $group['id'],
            'discip_id' => 1            
           ]);
        }

        DB::table("associations")->insert($data);
    }
}