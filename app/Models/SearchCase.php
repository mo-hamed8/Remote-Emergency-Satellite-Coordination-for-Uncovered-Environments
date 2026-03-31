<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function sateliteImages():HasMany{
        return $this->hasMany(SateliteImage::class,"search_case_id");
    }
}
