<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class ProcessOnlineStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $recentlySeenEncoded;

    private $expiredAt;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->expiredAt = now()->subSeconds(config('user.online.expire'));

        $recentlySeenRawKeys = Redis::keys('users:online:*');

        $recentlySeenKeys = preg_replace('/'.config('database.redis.options.prefix').'/', '', $recentlySeenRawKeys); // Removing laravel redis prefix

        $this->recentlySeenEncoded = Redis::mget($recentlySeenKeys);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->recentlySeenEncoded as $encodedUser) {
            $cachedUser = json_decode($encodedUser); // Decode the JSON stored in the cache

            if ($this->expiredAt > $cachedUser->last_active_at) {
                User::find($cachedUser->id)->goesOffline($cachedUser->last_active_at);
            }
        }
    }
}
