<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $fillable = ['activity_id','santri_id','status','note'];

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    public function santri(): BelongsTo
    {
        return $this->belongsTo(Santri::class);
    }
}
