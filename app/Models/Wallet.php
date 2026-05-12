<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    //

    protected $guarded = [];

    public function serviceProvider()
    {
        return $this->belongsTo(ApiServiceProvider::class);
    }
}
