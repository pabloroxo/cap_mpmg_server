<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function me(Request $request)
    {
        $user = auth('api')->user();

        return $user->only(['name', 'balance', 'agency', 'account']);
    }
}
