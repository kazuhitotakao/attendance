<?php

namespace Database\Seeders;

require './vendor/autoload.php';

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params_yesterday =
            [
                [
                    'user_id' => '1',
                    'break_time' => '3600',
                    'break_start_time' => '12:00:00',
                    'break_finish_time' => '13:00:00',
                ],
                [
                    'user_id' => '2',
                    'leaving_time' => Carbon::today()->subDay()->addHour(17),
                    'break_time' => '3900',
                    'break_start_time' => '12:00:00',
                    'break_finish_time' => '13:05:00',
                ],
                [
                    'user_id' => '3',
                    'leaving_time' => Carbon::today()->subDay()->addHour(17),
                    'break_time' => '3300',
                    'break_start_time' => '12:00:00',
                    'break_finish_time' => '12:55:00',
                ],
                [
                    'user_id' => '4',
                    'leaving_time' => Carbon::today()->subDay()->addHour(17),
                    'break_time' => '3600',
                    'break_start_time' => '12:00:00',
                    'break_finish_time' => '13:00:00',
                ],
                [
                    'user_id' => '5',
                    'leaving_time' => Carbon::today()->subDay()->addHour(17),
                    'break_time' => '3600',
                    'break_start_time' => '12:00:00',
                    'break_finish_time' => '13:00:00',
                ],
            ];
        foreach ($params_yesterday as $param_yesterday) {
            $param_yesterday['date'] = Carbon::today()->subDay();
            $param_yesterday['attend_time'] = Carbon::today()->subDay()->addHour(9);
            $param_yesterday['created_at'] = Carbon::now();
            $param_yesterday['updated_at'] = Carbon::now();
            DB::table('attendances')->insert($param_yesterday);
        }

        $params_today = 
            [
                [
                    'user_id' => '1',
                    'break_time' => '3600',
                    'break_start_time' => '12:00:00',
                    'break_finish_time' => '13:00:00',
                ],
                [
                    'user_id' => '2',
                    'break_time' => '3900',
                    'break_start_time' => '12:00:00',
                    'break_finish_time' => '13:05:00',
                ],
                [
                    'user_id' => '3',
                    'break_time' => '3300',
                    'break_start_time' => '12:00:00',
                    'break_finish_time' => '12:55:00',
                ],
                [
                    'user_id' => '4',
                    'break_time' => '3600',
                    'break_start_time' => '12:00:00',
                    'break_finish_time' => '13:00:00',
                ],
                [
                    'user_id' => '5',
                    'break_time' => '3600',
                    'break_start_time' => '12:00:00',
                    'break_finish_time' => '13:00:00',
                ],
            ];
        foreach ($params_today as $param_today) {
            $param_today['date'] = Carbon::today();
            $param_today['attend_time'] = Carbon::today()->addHour(9);
            $param_today['leaving_time'] = Carbon::today()->addHour(17);
            $param_today['created_at'] = Carbon::now();
            $param_today['updated_at'] = Carbon::now();
            DB::table('attendances')->insert($param_today);
        }

        $params_tomorrow =
            [
                [
                    'user_id' => '1',
                    'break_time' => '3600',
                    'break_start_time' => '12:00:00',
                    'break_finish_time' => '13:00:00',
                ],
                [
                    'user_id' => '2',
                    'break_time' => '3900',
                    'break_start_time' => '12:00:00',
                    'break_finish_time' => '13:05:00',
                ],
                [
                    'user_id' => '3',
                    'break_time' => '3300',
                    'break_start_time' => '12:00:00',
                    'break_finish_time' => '12:55:00',
                ],
                [
                    'user_id' => '4',
                    'break_time' => '3600',
                    'break_start_time' => '12:00:00',
                    'break_finish_time' => '13:00:00',
                ],
                [
                    'user_id' => '5',
                    'break_time' => '3600',
                    'break_start_time' => '12:00:00',
                    'break_finish_time' => '13:00:00',
                ],
            ];
        foreach ($params_tomorrow as $param_tomorrow) {
            $param_tomorrow['date'] = Carbon::today()->addDay();
            $param_tomorrow['attend_time'] = Carbon::today()->addDay()->addHour(9);
            $param_tomorrow['leaving_time'] = Carbon::today()->addDay()->addHour(17);
            $param_tomorrow['created_at'] = Carbon::now();
            $param_tomorrow['updated_at'] = Carbon::now();
            DB::table('attendances')->insert($param_tomorrow);
        }

    }
}
