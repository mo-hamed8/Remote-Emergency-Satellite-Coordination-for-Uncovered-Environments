<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderLog extends Model
{
    //4
    protected $fillable = [
        'api_service_provider_id',
        'request_payload',
        'response_payload',
        'status',
        'error_message',
    ];


}
