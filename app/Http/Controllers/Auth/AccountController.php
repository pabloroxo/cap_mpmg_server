<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function withdraw(Request $request)
    {
        $user = auth('api')->user();

        if(!password_verify($request->password, $user->password)) {
            return response('Senha incorreta. Tente novamente.', 406);
        }

        if(!is_numeric($request->amount)) {
            return response('Não foi informado um valor válido para saque.', 406);
        }

        if($request->amount <= 0) {
            return response('Não é possível sacar um valor igual ou menor a zero reais.', 406);
        }

        if($user->balance < $request->amount) {
            return response('Não é possível sacar pois não há saldo suficiente.', 406);
        }

        $user->balance -= $request->amount;

        $user->save();

        return $user->balance;
    }

    public function deposit(Request $request)
    {
        $user = auth('api')->user();

        if(!password_verify($request->password, $user->password)) {
            return response('Senha incorreta. Tente novamente.', 406);
        }

        if(!is_numeric($request->amount)) {
            return response('Não foi informado um valor válido para depósito.', 406);
        }

        if($request->amount <= 0) {
            return response('Não é possível depositar um valor igual ou menor a zero reais.', 406);
        }

        $user->balance += $request->amount;

        $user->save();

        return $user->balance;
    }

}
