<?php

namespace App\Http\Controllers\RouteControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\UsersPost;
use Debugbar;

use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','profilactic']);
    }

    public function saveUsers (Request $request)
    {
        try
        {
            Debugbar::info($request);
            return response()->json(['success'=>true]);
        }
        catch(MNF $e)
        {
            Debugbar::info("users_not_save");
            return response()->json(['error'=>$e],400);
        }
    }

    public function getUsers ()
    {
        $users = Users::get();
        $usersposts = UsersPost::get();
        return response()->json(['users'=>json_encode($users), 'usersposts' => json_encode($usersposts)],200);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Users::get();
        $usersposts = UsersPost::get();
        return view
        (
            'components/UserManagement', 
            [
                'users' => json_encode($users), 
                'usersposts' => json_encode($usersposts)
            ]
        );
    }
}
