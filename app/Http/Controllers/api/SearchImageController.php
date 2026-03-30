<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchImageController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $userId=$user->id;

        $request->validate(["search_case_id" => "required"]);

        $images = DB::table('satelite_images')
            ->leftJoin('image_analysis', function ($join) use ($userId) {
                $join->on('satelite_images.id', '=', 'image_analysis.image_id')
                    ->where('image_analysis.analyzed_by', '=', $userId);
            })
            ->whereNull('image_analysis.id')
            ->select('satelite_images.*')
            ->get();

        return $images;
    }
}
