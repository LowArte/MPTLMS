<?php

namespace App\Http\Controllers\RouteControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\UsersPost;
use App\User;
use Debugbar;
use Faker\Factory;

use Illuminate\Support\Facades\Hash;

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

    public function saveUser (Request $request)
    {
        try
        {
            $user = User::where("email",'=', $request->user["email"])->first();
            if($request->user["id"]==-1){ //new user
                if ($user != null)
                    return response()->json(['success'=>'erroremail']);
                $faker = Factory::create();
                $pas = $faker->password();
                $user = new User();
                $user->name = $request->user["name"];
                $user->secname = $request->user["secName"];
                $user->thirdname = $request->user["thirdName"];
                $user->email = $request->user["email"];
                $user->post_id = $request->user["post_id"];
                $user->disabled = $request->user["disabled"];
                $user->password = Hash::make($pas);
                $user->password_notHash = Hash::make($pas);
                $user->save();
            }else{ // update user
                if ($user != null && $user->id != $request->user["id"])
                    return response()->json(['success'=>'erroremail']);
                $user->name = $request->user["name"];
                $user->secname = $request->user["secName"];
                $user->thirdname = $request->user["thirdName"];
                $user->email = $request->user["email"];
                $user->post_id = $request->user["post_id"];
                $user->disabled = $request->user["disabled"];
                $user->save();
            }
            return response()->json(['success'=>true]);
        }
        catch(MNF $e)
        {
            return response()->json(['error'=>$e],400);
        }
    }

    public function deleteUser (Request $request)
    {
        try
        {
            $user = User::where("id",$request->id)->first();
            $user->delete();
            return response()->json(['success'=>true]);
        }
        catch(MNF $e)
        {
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
            'components/user-management', 
            [
                'users' => json_encode($users), 
                'usersposts' => json_encode($usersposts)
            ]
        );
    }
}