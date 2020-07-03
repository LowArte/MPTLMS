<?php

use App\Models\User;
use App\Models\Notifications;
use Illuminate\Database\Seeder;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::get();
        $data = [];
        foreach ($users as $user) {
           array_push($data,[
            'user_id' => $user->id,
            'info' => json_encode(array(['id' => 1,
                'icon' => "warning",
                'title' => "Система безопасности!",
                'subtitle' => "В ваш аккаунт был осуществёл вход с нового устройства!",
                'done' => false])),
           ]);
        }

        DB::table("notifications")->insert($data);
    }
}