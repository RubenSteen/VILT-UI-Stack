<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class UsersOnlineCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:online-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows the count of currently online users';

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
        $count = count(Redis::keys("users:online:*"));

        $this->info('Users currently online: '.$count);

        return $count;
    }
}
