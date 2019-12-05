<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Helpers\UserNotification;

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
        UserNotification::set_notification_as_read($request["id"]);
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
