<?php

namespace App\Console;


use App\Http\Controllers\PagespeedController;
use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\User;
use Laravel\Cashier\Console\Commands\CashierRun;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        $schedule->command('Pagespeed:GetPagespeed')->everyFifteenMinutes()->withoutOverlapping();
        //$schedule->command('app:browsershot')->hourly()->withoutOverlapping();
        $schedule->command(CashierRun::class)
            ->hourly() // run as often as you like (daily, monthly, every minute, ...)
            ->withoutOverlapping();

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
