<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProviderLogService;

class TestController extends Controller
{
    //

    public function test()
    {

        $requestPayload = [
            'latitude'  => '21.543333',
            'longitude' => '39.172779',
        ];

        $responsePayload = [
            'status' => 'ok',
            'image'  => 'satellite-image-url'
        ];

        ProviderLogService::createLog(
            1,

            $requestPayload,

            $responsePayload,

            'success'
        );

        return response()->json([
            'message' => 'log created successfully'
        ]);
    }
}
