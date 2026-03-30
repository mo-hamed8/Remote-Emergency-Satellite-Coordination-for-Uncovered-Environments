<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageAnalysis extends Model
{
    //
    protected $guarded = [];

    public function satelliteImage():BelongsTo{
        return $this->belongsTo(SateliteImage::class);
    }

    public function analyst():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
