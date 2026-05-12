<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ProviderLog;
use Illuminate\Http\Request;

class ProviderLogController extends Controller
{
    //
    public function getProviderLogs($providerId)
    {
        $logs = ProviderLog::where('api_service_provider_id', $providerId)
            ->latest()
            ->get();

        return response()->json([
            'provider_id' => $providerId,
            'logs' => $logs
        ]);
    }
}
