<?php

namespace App\Http\Controllers;

require '../vendor/autoload.php';

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function addAttendTime()
    {
        $attendance = new Attendance;
        $attendance->date = Carbon::now();
        $attendance->attend_time = Carbon::now();
        $attendance->user_id = Auth::id();
        $attendance->save();
        return redirect('/');
    }

    public function addLeavingTime()
    {
        $today = Carbon::now()->toDateString();
        $attendance = Attendance::where('user_id', Auth::id())->where('date', $today)->first();
        $attendance->leaving_time = Carbon::now();
        $attendance->save();
        return redirect('/');
    }

    public function addBreakStartTime()
    {
        $today = Carbon::now()->toDateString();
        $attendance = Attendance::where('user_id', Auth::id())->where('date', $today)->first();
        $attendance->break_start_time = Carbon::now();
        $attendance->save();
        return redirect('/');
    }

    public function addBreakFinishTime()
    {
        $today = Carbon::now()->toDateString();
        $attendance = Attendance::where('user_id', Auth::id())->where('date', $today)->first();
        $attendance->break_finish_time = Carbon::now();

        $break_start = $attendance->break_start_time;
        $break_finish = $attendance->break_finish_time;

        $diffInSeconds = $break_start->diffInSeconds($break_finish);
        $attendance->break_time = $diffInSeconds;
        $attendance->save();
        return redirect('/');
    }
}
