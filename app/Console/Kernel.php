<?php

namespace App\Console;

use App\Console\Command\DownRank;
use App\Console\Commands\InserUser;
use App\Console\Commands\MakeBreadcrumb;
use App\Console\Commands\UpdateRank;
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
        UpdateRank::class,
        InserUser::class,
        MakeBreadcrumb::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // php artisan schedule:run
        $schedule->command('command:UpdateRank')->daily();
        $schedule->command('command:insertUser')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
