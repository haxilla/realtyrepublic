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
        Commands\retsCronStart::class,
        Commands\adreUpdate::class,
        Commands\bounceAuto::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //ADRE update
        //weekly
        $schedule
            ->command('adre:update')
            ->daily()
            ->withoutOverlapping()
            ->name("ADRE cronstart!")
            ->emailOutputOnFailure('subscriber2016@yahoo.com');

        //bounce Auto
        //every 15min
        $schedule
            ->command('bounce:auto')
            ->everyFifteenMinutes()
            ->withoutOverlapping()
            ->name("bounceAuto cronstart!")
            ->emailOutputOnFailure('subscriber2016@yahoo.com');

        //RETS update
        //every 4hrs
        $schedule
            ->command('rets:cronstart')
            ->name("RETS cronstart!")
            ->cron('0 */4 * * *')
            ->withoutOverlapping()
            ->emailOutputOnFailure('subscriber2016@yahoo.com');

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
