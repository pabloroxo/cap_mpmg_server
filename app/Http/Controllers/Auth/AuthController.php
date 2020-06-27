<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if(!$token = auth('api')->attempt($request->only('email', 'password'))) {
            return response(null, 401);
        }

        return response()->json([
            'token' => $token,
        ]);
    }

    public function logout()
    {
        auth('api')->logout();
    }
}
