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
        //
        '\App\Console\Commands\Feeding',
        '\App\Console\Commands\FeedingCorrecao',
        '\App\Console\Commands\GrupoDisable',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('feeding:update')
                ->everyTenMinutes();
        $schedule->command('feeding:correcao')
                ->daily();
        $schedule->command('grupo:disable')
                ->daily();
        //Spatie\Backup
        $schedule->command('backup:clean --disable-notifications')->dailyAt('01:30');
        $schedule->command('backup:run --only-db --disable-notifications')->dailyAt('01:35');
                
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
