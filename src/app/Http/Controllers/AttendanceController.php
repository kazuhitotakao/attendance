<?php
namespace App\Http\Controllers;
require '../vendor/autoload.php';

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function addAttendtime()
    {
        $item = new Attendance;
        $item->date = Carbon::now();
        $item->attend_time = Carbon::now();
        $item->user_id = Auth::id();
        $item->save();
        return redirect('/');
    }
}
