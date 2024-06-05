<?php

namespace App\Http\Controllers;

require '../vendor/autoload.php';

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class AttendanceController extends Controller
{
    public function attendance()
    {
        $attendance_day = Carbon::today();
        $attendances = Attendance::with('User')
                        ->whereDate('date', $attendance_day)
                        ->orderBy('user_id', 'asc')
                        ->Paginate(5);
        return view('attendance', compact('attendances', 'attendance_day'));
    }

    public function attendanceMove(Request $request)
    {
        $attendance_day = Carbon::createFromTimeString($request->attendance_day);
        $attendances = Attendance::with('User')
                        ->whereDate('date', $attendance_day)
                        ->orderBy('user_id', 'asc')
                        ->Paginate(5);
        return view('attendance', compact('attendances', 'attendance_day'));
    }

    public function index()
    {
        $today = Carbon::today();
        $attendance = Attendance::where('user_id', Auth::id())->whereDate('date', $today)->first();
        // 就業前（user_idなし）
        if (empty($attendance->user_id)) {
            JavaScriptFacade::put([
                'flgAttend' => false,
                'flgLeaving' => true,
                'flgBreakStart' => true,
                'flgBreakFinish' => true,
            ]);
            // 勤務終了（leaving_timあり）
        } elseif (!empty($attendance->leaving_time)) {
            JavaScriptFacade::put([
                'flgAttend' => true,
                'flgLeaving' => true,
                'flgBreakStart' => true,
                'flgBreakFinish' => true,
            ]);
            // 休憩開始：１度目の休憩開始ボタンクリック（break_start_time追加）
        } elseif (!empty($attendance->break_start_time) && empty($attendance->break_finish_time)) {
            JavaScriptFacade::put([
                'flgAttend' => true,
                'flgLeaving' => true,
                'flgBreakStart' => true,
                'flgBreakFinish' => false,
            ]);
            // 休憩開始終了：１度目の休憩終了と２度目以降の休憩開始終了
        } elseif (!empty($attendance->break_start_time) && !empty($attendance->break_finish_time)) {
            if ($attendance->break_start_time <= $attendance->break_finish_time) {
                JavaScriptFacade::put([
                    'flgAttend' => true,
                    'flgLeaving' => false,
                    'flgBreakStart' => false,
                    'flgBreakFinish' => true,
                ]);
            } elseif ($attendance->break_start_time > $attendance->break_finish_time) {
                JavaScriptFacade::put([
                    'flgAttend' => true,
                    'flgLeaving' => true,
                    'flgBreakStart' => true,
                    'flgBreakFinish' => false,
                ]);
            }
            // 勤務開始：出勤ボタンクリック（ID,date,attend_time追加）attend_time以外は空データ
        } elseif (!empty($attendance->attend_time)) {
            JavaScriptFacade::put([
                'flgAttend' => true,
                'flgLeaving' => false,
                'flgBreakStart' => false,
                'flgBreakFinish' => true,
            ]);
        }
        return view('index');
    }


    public function addAttendTime()
    {
        $attendance = new Attendance;
        $attendance->date = Carbon::today();
        $attendance->attend_time = Carbon::now();
        $attendance->user_id = Auth::id();
        $attendance->save();
        return redirect('/');
    }

    public function addLeavingTime()
    {
        $today = Carbon::today();
        $attendance = Attendance::where('user_id', Auth::id())->whereDate('date', $today)->first();
        $attendance->leaving_time = Carbon::now();
        $attendance->save();
        return redirect('/');
    }

    public function addBreakStartTime()
    {
        $today = Carbon::today();
        $attendance = Attendance::where('user_id', Auth::id())->whereDate('date', $today)->first();
        $attendance->break_start_time = Carbon::now();
        $attendance->save();
        return redirect('/');
    }

    public function addBreakFinishTime()
    {
        $today = Carbon::today();
        $attendance = Attendance::where('user_id', Auth::id())->whereDate('date', $today)->first();
        $attendance->break_finish_time = Carbon::now();

        $break_start = $attendance->break_start_time;
        $break_finish = $attendance->break_finish_time;

        $diffInSeconds = $break_start->diffInSeconds($break_finish);
        $attendance->break_time = $attendance->break_time + $diffInSeconds;
        $attendance->save();
        return redirect('/');
    }
}
