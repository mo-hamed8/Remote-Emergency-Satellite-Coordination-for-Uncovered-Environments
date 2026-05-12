<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiServiceProvider extends Model
{
    //
    protected $fillable = [
        'name',
        'base_url',
        'api_key',
        'secret_key',
        'status',
        'rate_limit',
        'description',
    ];
}
