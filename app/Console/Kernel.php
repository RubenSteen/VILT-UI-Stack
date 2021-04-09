<?php

namespace App\Console;

use App\Console\Commands\NewUsersCurrentMonth;
use App\Jobs\ProcessGhostedOnlineStates;
use App\Jobs\ProcessOnlineStatus;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        if (App::environment('local')) {
            $schedule->call(function () {
                Log::notice('Confirmation that cron has ran laravel scheduler (this will log every minute)');
            })->everyMinute();
        }

        $schedule->command(NewUsersCurrentMonth::class)->dailyAt('2:00');

        $schedule->job(new ProcessOnlineStatus)->everyMinute();

        $schedule->job(new ProcessGhostedOnlineStates)->everyTenMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
