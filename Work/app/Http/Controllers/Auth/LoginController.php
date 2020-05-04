<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\ModelRepository\SiteOptionsRepository;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        if (!auth()->attempt($credentials)) {
            return response()->json([], 422);
        }

        $siteOptionsRepository = app(SiteOptionsRepository::class);
        $options = $siteOptionsRepository->getIsProfilactic();
        $user = auth()->user();

        if($options && $user['post_id']!=1)
        {
            return response()->json(["profilactic"=>true], 200);
        }

        $user->load("post");
        $user->load("student");
        $user->load("teacher");
        if($user->student)
        {
            $user->student->load("group:id,group_name,curs,department_id");
            $user->student->group->load("department:id,dep_name_full,studysperiod,qualification");
        }
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();



        return response()->json([
            'user' => $user,
            'token'=>$tokenResult->accessToken
        ]);
    }

    public function logout()
    {
        $user = auth()->user();
        foreach ($user->tokens as $token) {
            $token->revoke();
        }
        auth()->logout();
        return response()->json(["success" => true]);
    }

    public function getToken()
    {
        $siteOptionsRepository = app(SiteOptionsRepository::class);
        $options = $siteOptionsRepository->getIsProfilactic();
        $user = auth()->user();
        if($options && $user['post_id']!=1)
        {
            return response()->json(["profilactic"=>true], 200);
        }
        if (!$user) {
            return response()->json(["success" => false], 200);
        }
        $user->load("post");
        $user->load("student");
        $user->load("teacher");
        if($user->student)
        {
            $user->student->load("group:id,group_name,curs,department_id");
            $user->student->group->load("department");
        }
        return response()->json(["success" => true, "user" => $user]);
    }
}
