<?php

namespace App\Console;


use App\Http\Controllers\PagespeedController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\User;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        $schedule->call(function (){
            $users = User::all();
            foreach ($users as $user) {
                $controller = new \App\Http\Controllers\PagespeedController();
                $controller->create($user);
            }
        })->everyFiveMinutes();

            //->dailyAt('01:00');
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
