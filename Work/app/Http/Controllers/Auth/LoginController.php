<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Hash;

use Debugbar;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        if (!auth()->attempt($credentials))
            return response()->json([
                'message' => 'Bad data'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        return response()->json([
            'user' => $user,
            'routes' =>$user->post->privilegies,
            'slug'=>$user->post->slug
        ]);
    }

    public function getToken(Request $request){
        $user = auth()->user();
        if(!$user){
            return response()->json(["success"=>false],200);
        }
        return response()->json(["success"=>true,"user"=>$user,'routes' =>$user->post->privilegies,'slug'=>$user->post->slug]);
    }
}
