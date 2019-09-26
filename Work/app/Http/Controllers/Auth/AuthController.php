<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Users;
use Debugbar;
use Hash;

class AuthController extends Controller
{
    public function init()
    { 
        $user = Auth::user();
        return response()->json(['user'=>$user],200);
    }

    public function login(Request $request)
    {
        Debugbar::info($request);
        if (Auth::attempt(['login_email' => $request->login_email, 'password' => $request->password])) {
            $user = Auth::user();
            $user->api_token = str_random(60);
            $user->save();
            return response()->json([
                'success' => true,
                'user' => Auth::user()
            ], 200);
        } 
        else 
        {
            return response()->json([
                'errors' => 'These credentials do not match our records.'
            ], 422);
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->api_token = null;
        $user->save();
        Auth::logout();
        return response()->json([
            'success' => true
        ]);
    }
}
