<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ImageAnalysis;
use App\Models\SateliteImage;
use App\Models\SearchCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            ->limit(10)
            ->get()->map(function ($image) {
            $image->image_url = Storage::url($image->path);
            return $image;
        });

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

    public function suspectedImages(Request $request)
    {
        $request->validate(["search_case_id" => "required"]);

        $imgs = SateliteImage::where('search_case_id', $request->search_case_id)
            ->whereHas('analysis', function ($query) {
                $query->whereNotNull('point')
                    ->where('status', 'pending');
            })
            ->with(['analysis:id,image_id'])
            ->get()
            ->map(function ($image) {
                return [
                    'id' => $image->id,
                    'search_case_id' => $image->search_case_id,
                    'filename' => $image->filename,
                    'path' => $image->path,
                    "size" => $image->size,
                    "created_at" => $image->created_at,
                    "updated_at" => $image->updated_at,
                    'analysis_id' => $image->analysis->first()?->id,
                ];
            });

        return $imgs;
    }

    public function closeSuspicion(Request $request)
    {
        $request->validate([
        'analysis_id' => 'required|exists:image_analysis,id',
        'status' => 'required|in:confirmed,rejected'
        ]);

        $analysis = ImageAnalysis::find($request->analysis_id);
        $analysis->update([
            'status' => $request->status
        ]);
        return response()->json([
            "success"=>true,
            "message"=>"status updated successfully."
        ]);
    }
}
