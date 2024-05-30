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
        'break_start_time',
        'break_finish_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
