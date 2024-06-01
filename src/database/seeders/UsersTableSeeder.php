<?php

namespace Database\Seeders;

require './vendor/autoload.php';

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params =
            [
                [
                    'name' => 'テスト太郎',
                    'email' => 'test1@test1',
                    'password' => bcrypt('password1'),
                ],
                [
                    'name' => 'テスト次郎',
                    'email' => 'test2@test2',
                    'password' => bcrypt('password2'),
                ],
                [
                    'name' => 'テスト三郎',
                    'email' => 'test3@test3',
                    'password' => bcrypt('password3'),
                ],
                [
                    'name' => 'テスト四郎',
                    'email' => 'test4@test4',
                    'password' => bcrypt('password4'),
                ],
                [
                    'name' => 'テスト五郎',
                    'email' => 'test5@test5',
                    'password' => bcrypt('password5'),
                ]
            ];

        $now = Carbon::now();
        foreach ($params as $param) {
            $param['created_at'] = $now;
            $param['updated_at'] = $now;
            DB::table('users')->insert($param);
        }
    }
}
