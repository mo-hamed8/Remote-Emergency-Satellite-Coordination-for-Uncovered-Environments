<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ImageAnalysis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchImageController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;

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

    public function analyse(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            "image_id" => "required|exists:satelite_images,id",
            "point" => "nullable|string",
            "description" => "nullable|string",
        ]);

        ImageAnalysis::create([
            'image_id'     => $request->image_id,
            'analyzed_by'  => $user->id,
            'point'        => $request->point,
            'description'  => $request->description,
        ]);

        return response()->json([
            "success" => true,
            "message" => "Image analysis created successfully.",
            "data"    => []
        ], 201);
    }
}
