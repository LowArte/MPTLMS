<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use Debugbar;
use Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = Users::whereEmail($request->login_email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $user->api_token = str_random(60);
            $user->save();
            return response()->json([
                'success' => true,
                'user' => $user->info()
            ]);
        }
        return response()->json([
            'errors' => [
                'email' => 'These credentials do not match our records.'
            ]
        ], 422);
    }

    public function logout(Request $request)
    {
        Debugbar::info($request->user_id);
        $user = Users::whereId($request->user_id)->first();
        Debugbar::info($user);
        $user->api_token = null;
        $user->save();
        return response()->json([
            'success' => true
        ]);
    }
}

