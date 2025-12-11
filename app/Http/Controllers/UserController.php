<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(LoginRequest $request) {
        $user = User::where('email', $request->get('email'))->first();
        if (!$user || !Hash::check($request->get('password'), $user->password)) {
            return response()->json(['error' => [
                'code'=>401,
                'message'=>'Authentication failed'
            ]], 401);
        }

        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'data'=>[
                'user_token'=>$token,
            ],
        ]);
    }

    public function register(RegisterRequest $request) {
        $password = Hash::make($request->get('password'));
        $user = User::create([
            'fio'=>$request->get('fio'),
            'email'=>$request->get('email'),
            'password'=>$password,
        ]);

        $user->carts()->create([]);

        $token = $user->createToken(rand())->plainTextToken;

        return response()->json([
            'data'=>[
                'user_token'=>$token,
            ],
        ]);
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return response()->json([
            'data'=>[
                'message'=>'logout'
            ]
        ]);
    }
}
