<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ApiServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServiceProviderController extends Controller
{

    public function index()
    {
        $providers = ApiServiceProvider::with("wallet")->get();

        return response()->json([
            'success' => true,
            'data' => $providers
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'base_url' => 'required|url',
            'api_key' => 'nullable|string',
            'secret_key' => 'nullable|string',
            'status' => ['nullable', Rule::in(['active', 'inactive'])],
            'rate_limit' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        $provider = ApiServiceProvider::create($validated);

        $provider->wallet()->create();

        return response()->json([
            'success' => true,
            'message' => 'Service Provider created successfully',
            'data' => $provider
        ], 201);
    }


    public function show($id)
    {
        $provider = ApiServiceProvider::find($id);

        if (!$provider) {
            return response()->json([
                'success' => false,
                'message' => 'Service Provider not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $provider
        ]);
    }


    public function update(Request $request, $id)
    {
        $provider = ApiServiceProvider::find($id);

        if (!$provider) {
            return response()->json([
                'success' => false,
                'message' => 'Service Provider not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'base_url' => 'sometimes|url',
            'api_key' => 'nullable|string',
            'secret_key' => 'nullable|string',
            'status' => ['nullable', Rule::in(['active', 'inactive'])],
            'rate_limit' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        $provider->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Service Provider updated successfully',
            'data' => $provider
        ]);
    }

}
