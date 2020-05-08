<?php

use App\Models\UsersPost;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = UsersPost::get();
        $data = [];
        foreach ($roles as $role) {
           array_push($data,[
            'name'=>$role->slug,
            'secName'=> $role->id,
            'thirdName'=> '1',
            'email'=>$role->slug."@mpt.ru",
            'password' =>Hash::make("secret"),
            'disabled' =>false,
            'post_id' => $role->id
           ]);
        }

        DB::table("users")->insert($data);
    }
}