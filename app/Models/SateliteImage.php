<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SateliteImage extends Model
{
    //


    public function analysis():HasMany{
        return $this->hasMany(ImageAnalysis::class,"image_id");
    }

    public function searchCase():BelongsTo{
        return $this->belongsTo(SearchCase::class,"search_case_id");
    }
}
