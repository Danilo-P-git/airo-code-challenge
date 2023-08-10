<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(AuthRequest $request)
    {
        $attempt = Auth::attempt($request->only(['email', 'password']));
        // dd('ciao');

        if ($attempt) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken');
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['message' => 'Invalid credential'], 401);
        }
    }
}
