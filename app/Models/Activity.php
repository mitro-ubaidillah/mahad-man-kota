<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Attendance;
use App\Models\Kelas;

class Activity extends Model
{
    protected $fillable = ['title','description','activity_date','start_date','end_date','start_time','end_time','until_finished','recurring_daily','recurrence_type','weekdays','kelas_id'];

    /**
     * Cast date/time and json fields to appropriate types.
     */
    protected $casts = [
        'activity_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'start_time' => 'string',
        'end_time' => 'string',
        'until_finished' => 'boolean',
        'recurring_daily' => 'boolean',
        'recurrence_type' => 'string',
        'weekdays' => 'array',
    ];

    /**
     * Helper to present schedule as human readable string.
     */
    public function displaySchedule(): string
    {
        // Build a time suffix depending on stored times and until_finished
        $timeSuffix = '';
        if($this->until_finished && $this->end_time){
            $timeSuffix = ' (sampai ' . $this->end_time . ')';
        } elseif($this->start_time && $this->end_time){
            $timeSuffix = ' (' . $this->start_time . ' - ' . $this->end_time . ')';
        } elseif($this->start_time){
            $timeSuffix = ' (' . $this->start_time . ')';
        }

        if($this->recurrence_type === 'daily'){
            return 'Harian' . $timeSuffix;
        }

        if($this->recurrence_type === 'weekdays' && is_array($this->weekdays) && count($this->weekdays)){
            return implode(',', $this->weekdays) . $timeSuffix;
        }

        if($this->start_date && $this->end_date){
            return $this->start_date->format('Y-m-d') . ' - ' . $this->end_date->format('Y-m-d') . $timeSuffix;
        }

        if($this->start_date){
            return $this->start_date->format('Y-m-d') . $timeSuffix;
        }

        return $this->activity_date?->format('Y-m-d') . $timeSuffix ?? '-';
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

}
