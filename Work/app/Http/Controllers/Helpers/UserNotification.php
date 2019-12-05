<?php

namespace App\Http\Controllers\Helpers;

use App\Notifications\BaseNotification;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserNotification{

    public static function notify($text,$user = null,$post_id = null)
    {
        if($user  != null){
            $user->notify(new BaseNotification($text));
            return;
        }
        $users = null;
        if($post_id!=null){
            $users = User::where("post_id",$post_id)->get();
        }
        else{
            $users = User::get();
        }

        foreach ($users as $us) {
            $us->notify(new BaseNotification($text));
        }
    }

    public static function set_notification_as_read($id){
        foreach(Auth::user()->unreadNotifications as $notif){
            if($notif->id == $id){
                $notif->markAsRead();           
                break;
            }
        }
    }
}