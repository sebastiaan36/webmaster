<?php

namespace App\Console;


use App\Http\Controllers\PagespeedController;
use App\Models\Link;
use Carbon\Carbon;
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

            $links = Link::where('updated_at', '<', Carbon::today()->toDateString())->first();
            if($links) {
                $controller = new \App\Http\Controllers\PagespeedController();
                $result = $controller->create($links);
                if ($result) {
                    Link::where('id', '=', $links->id)->update(['url' => $links->url]);
                }
            }

        })->everyFiveMinutes();


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
