<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use Debugbar;

/**
 * Class LoggedUserController.
 *
 * @package App\Http\Controllers
 */
class LoggedUserController extends Controller
{
    
    public function setNotificationAsRead(Request $request)
    {
        foreach(Auth::user()->unreadNotifications as $notif){
            if($notif->id==$request["id"]){
                $notif->markAsRead();           
                break;
            }
        }
    }
    /**
     * Update user.
     * @param Request $request
     * @return \App\User|null
     */
    public function update(Request $request)
    {
        Auth::user()->update($request->only(['name','email']));
        return Auth::user();
    }
}
