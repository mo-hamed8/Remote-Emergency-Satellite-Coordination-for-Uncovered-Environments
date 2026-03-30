<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SearchCaseResource;
use App\Models\ExpectedLocation;
use App\Models\SearchCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searchCases = SearchCase::latest()->get();
        return SearchCaseResource::collection($searchCases);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user=Auth::user();

        $request->validate([
            "title"=>"required|string",
            "description"=>"required|string",
            "point"=>"required"
        ]);

        $searchCase=$user->searchCase()->create([
            "title"=>$request->title,
            "description"=>$request->description,
        ]);

        ExpectedLocation::create([
            "coordinates"=>$request->point,
            "added_by"=>$user->id,
            "search_case_id"=>$searchCase->id
        ]);

        return response()->json([
                "success"=> true,
                "message"=> "Search case created successfully.",
                "data"=>[]

            ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
