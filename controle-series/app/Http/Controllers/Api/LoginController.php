<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(Request $request) {
        $credentials = $request->only(['email', 'password']);
        if(Auth::attempt($credentials) === false) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        
        // Código comentado funciona, mas é vulnerável a timng attack
        // $user = User::where('email', $credentials['email'])->first();

        // if($user === null || Hash::check($credentials['password'], $user->password) === false) {
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }
        $user = Auth::user();
        $token = $user->createToken('token');
        return response()->json(['token' => $token->plainTextToken], 200);
        // dd($token);
    }
}
