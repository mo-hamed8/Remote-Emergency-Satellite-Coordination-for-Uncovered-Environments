<?php

namespace App\Services;

use App\Models\ProviderLog;

class ProviderLogService
{
public static function createLog(
    int $apiServiceProviderId,
    array|string|null $requestPayload,
    array|string|null $responsePayload,
    string $status,
    ?string $errorMessage = null
): ProviderLog {

    return ProviderLog::create([
        'api_service_provider_id' => $apiServiceProviderId,

        'request_payload' => is_array($requestPayload)
            ? json_encode($requestPayload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
            : $requestPayload,

        'response_payload' => is_array($responsePayload)
            ? json_encode($responsePayload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
            : $responsePayload,

        'status' => $status,

        'error_message' => $errorMessage,
    ]);
}


    public static function success(
        array|string|null $requestPayload,
        array|string|null $responsePayload
    ): ProviderLog {

        return self::createLog(
            $requestPayload,
            $responsePayload,
            'success'
        );
    }

    public static function failed(
        array|string|null $requestPayload,
        ?string $errorMessage = null,
        array|string|null $responsePayload = null
    ): ProviderLog {

        return self::createLog(
            $requestPayload,
            $responsePayload,
            'failed',
            $errorMessage
        );
    }
}
