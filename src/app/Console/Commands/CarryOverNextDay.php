<?php

namespace App\Console\Commands;

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
    }
}
