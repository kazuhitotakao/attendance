<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CarryOverNextDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:carryover';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '退勤忘れ＆夜勤対応処理';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        logger('Carry Over!');
        $today = Carbon::today();
        $yesterday = Carbon::today()->subDay();
        $attendances_yesterday = Attendance::with('User')
            ->whereDate('date', $yesterday)
            ->whereNull('leaving_time',)
            ->get();
        foreach ($attendances_yesterday as $attendance_yesterday) {
            $attendance_yesterday->leaving_time = $today->subSeconds();
            $attendance_yesterday->save();
            $today->addSeconds();
            $attendance_today = new Attendance;
            $attendance_today->date = $today;
            $attendance_today->attend_time = $today;
            $attendance_today->user_id = $attendance_yesterday->user_id;
            $attendance_today->save();
        }
    }
}
