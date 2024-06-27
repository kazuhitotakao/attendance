<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'attend_time',
        'leaving_time',
        'break_time',
        'break_start_time',
        'break_finish_time',
        'user_id',
    ];
    protected $dates = [
        'attend_time',
        'leaving_time',
        'break_start_time',
        'break_finish_time',
    ];

    public function getBreakTimeTotalAttribute()
    {
        $break_time = $this->break_time;
        if (empty($break_time)) {
            $break_time = 0;
            return gmdate("H:i:s", $break_time);
        } else {
            return gmdate("H:i:s", $break_time);
        }
    }

    public function getWorkingHoursAttribute()
    {
        $attend_time = $this->attend_time;
        $leaving_time = $this->leaving_time;
        $break_time = $this->break_time;
        if (!empty($leaving_time)) {
            $attend_leaving_diff = $attend_time->diffInSeconds($leaving_time);
            $working_hours = $attend_leaving_diff - $break_time;
            return gmdate("H:i:s", $working_hours);
        } else {
            $working_hours = 0;
            return gmdate("H:i:s", $working_hours);
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
