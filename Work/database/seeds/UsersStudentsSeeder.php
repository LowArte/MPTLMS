<?php

use App\Models\Group;
use Illuminate\Database\Seeder;

class UsersStudentsSeeder extends Seeder
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
            for($i = 1; $i <= 5; $i++)
            {
                array_push($data,[
                    'name'=>'student_'.$i.'_'.$group->group_name,
                    'secName'=>"Фамилия",
                    'thirdName'=>$group->id,
                    'email'=>'student_'.$i.'_'.$group->group_name."@mpt.ru",
                    'password' =>Hash::make("secret"),
                    'disabled' =>false,
                    'post_id' => 2
                ]);
            }
        }

        DB::table("users")->insert($data);
    }
}