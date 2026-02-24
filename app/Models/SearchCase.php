<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SearchCase extends Model
{
    //
    protected $fillable = [
        'title',
        'description'
    ];

    public function creator():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
