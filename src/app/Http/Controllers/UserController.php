<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {   
        $users = User::orderBy('id', 'asc')
            ->Paginate(5);
        return view('user_list', compact('users'));
    }

    public function search(Request $request)
    {
        if ($request->has('reset')) {
            return redirect('/user');
        }

        $users = User::where('name', 'like', '%' . $request->keyword . '%')
            ->orWhere('email', 'like', '%' . $request->keyword . '%')
            ->paginate(5);
        return view('user_list', compact('users'));
    }

    public function record(Request $request){
        $record_day = Carbon::today();
        $user = User::find($request->id);
        $records = Attendance::with('User')
            ->where('user_id', $request->id)
            ->whereMonth('date', $record_day->month)
            ->orderBy('date', 'asc')
            ->paginate(5);
        return view('user_record', compact('records', 'user' , 'record_day'));
    }

    public function recordMove(Request $request)
    {
        $record_day = Carbon::createFromTimeString($request->record_day);
        $user = User::find($request->id);
        $records = Attendance::with('User')
            ->where('user_id', $request->id)
            ->whereMonth('date', $record_day->month)
            ->orderBy('date', 'asc')
            ->paginate(5);
        return view('user_record', compact('records', 'user', 'record_day'));
    }
}
