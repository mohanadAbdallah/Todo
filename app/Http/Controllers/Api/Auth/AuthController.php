<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        if (is_null($user) || !Auth::getProvider()->validateCredentials($user, $credentials)) {
            throw new \Exception('invalid');
        }
        return response()->json(['data' => $user], 200);
    }
}
