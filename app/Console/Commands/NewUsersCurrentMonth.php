<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class NewUsersCurrentMonth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:new-current-month';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the amount of newly created users for the current month runs once per day';

    /**
     * Carbon instance of the start of the month.
     *
     * @var object
     */
    protected $startOfMonth;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->startOfMonth = now()->startOfMonth();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Running command \'users:new-current-month\'');

        $amount = User::where('created_at', '>=', $this->startOfMonth)->count();

        Redis::set('new-users-current-month', $amount);

        $this->info('Finished running command \'users:new-current-month\'');
    }
}
