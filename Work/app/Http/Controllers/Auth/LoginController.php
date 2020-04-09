<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $user = auth()->user();
        $user->load("post");
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
        $user = auth()->user();
        if (!$user) {
            return response()->json(["success" => false], 200);
        }
        $user->load("post");
        return response()->json(["success" => true, "user" => $user]);
    }
}
