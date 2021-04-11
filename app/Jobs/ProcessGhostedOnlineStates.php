<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class ProcessGhostedOnlineStates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::notice('Running ProcessGhostedOnlineStatus');

        User::whereNull('last_active_at')->chunk(100, function ($users) {
            foreach ($users as $user) {
                if (! Redis::exists(config('redis.keys.users.online').':'.$user->id)) {
                    $user->goesOffline(now()->subSeconds(config('user.online.expire')), true);
                }
            }
        });

        Artisan::call('users:online-count'); // Will update Redis
    }
}
