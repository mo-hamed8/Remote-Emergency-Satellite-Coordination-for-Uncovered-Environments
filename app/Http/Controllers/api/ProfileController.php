<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\json;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user=Auth::user();
        $analysesCount=$user->analysis()->count();

        return response()->json([
            "name"=>$user->name,
            "email"=>$user->email,
            "phone"=>$user->phone,
            "role"  => $user->role ?? "volunteer",
            "analysesCount"=>$analysesCount
        ]);

    }

    public function findUser(Request $request){

        $user = User::where(function ($query) use ($request) {
        if ($request->email) {
            $query->orWhere('email', $request->email);
        }

        if ($request->phone) {
            $query->orWhere('phone', $request->phone);
        }
        })->first();

        return response()->json($user);

    }
}
