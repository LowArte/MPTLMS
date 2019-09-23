<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api')
            ->only('logout');
    }

    public function login(Request $request) {
        $this->validate($request, [
            'login_email' => 'required|email',
            'password' => 'required|between:6,25'
        ]);
        $user = Users::whereEmail($request->login_email)->first();
        if($user && Hash::check($request->password, $user->password)) {
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

    public function logout(Request $request) {
        $user = $request->user();
        $user->api_token = null;
        $user->save();
        return response()->json([
            'success' => true
        ]);
    }

}
