<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
        'App\Console\Commands\DueCollection',
        'App\Console\Commands\DueDownpayment',
        'App\Console\Commands\CheckNotification',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();

        $schedule->command('due:downpayment')
            ->everyMinute();

        $schedule->command('due:collection')
            ->everyMinute();

        $schedule->command('notification:check')
            ->everyMinute();
    }
}
