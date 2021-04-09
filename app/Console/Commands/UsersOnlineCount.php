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
        $amount = count(Redis::keys('users:online:*'));

        Redis::set(config('redis.keys.users.online_count'), $amount);

        $this->info('Users currently online: '.$amount);

        return $amount;
    }
}
