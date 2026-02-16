<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    //
    public function register(Request $request){
        $request->validate([
            "name"=>"required|string|max:255",
            "email"=>"required|email|unique:users,email",
            "password"=>"required|confirmed"
        ]);

        $user=User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password)
        ]);
        return response()->json(UserResource::make($user),201);

    }

    public function login(Request $request){
        $request->validate([
            "email"=>"required|email",
            "password"=>"required"
        ]);
        $user=User::where("email",$request->email)->first();
        if(Hash::check($request->password, $user->password)){
            $token=$user->createToken("auth-token")->plainTextToken;
            return response()->json([
                "success"=> true,
                "message"=> "login successful",
                "data"=>[
                    "user"=>UserResource::make($user),
                    "token"=>$token
                ]

            ]);
        }

        return response()->json([
                "success"=> false,
                "message"=> "login failed. invalid email or password.",
                "data"=>[]

            ]);

    }

    public function logout(Request $request){
        Auth::user()->tokens()->delete();
        return response()->json([
                "success"=> true,
                "message"=> "logged out successfully.",
                "data"=>[]

            ]);
    }
}
