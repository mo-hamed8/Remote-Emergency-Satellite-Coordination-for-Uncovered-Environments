<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
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

}
