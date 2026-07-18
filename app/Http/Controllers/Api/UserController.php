<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function login(Request $request){
        $validator = validator()->make($request->all(), ["email" => 
            "required", "email", 
            "password" => "required"
        ]);
        if($validator->fails()){
            //Return $validator->errors();
            return response()->json($validator->errors(), 422);
        }
        $credentials = $validator->validated();
        // dd($credentials);
        if(Auth::attempt($credentials)){
            // session()->regenerate(); // SPA con Cookie
            // return response()->json('Logueo exitoso'); // SPA con Cookie
            // dd(auth()->user()->createToken('myapptoken'));
            $token = auth()->user()->createToken('myapptoken')->plainTextToken;
            return response()->json($token);

        }else{
            return response()->json('Credenciales incorrectas', 401);
        }
    }

    function logout() {
        //Remove all tokens...
        $user->tokens()->delete();

        //Remove a especific tokens...
        $user->tokens()->where('id', $tokenId)->delete();
    }
}
