<?php


namespace App\Console\Commands;

use App\Models\Pagespeed;
use Illuminate\Console\Command;

class GetPagespeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-pagespeed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //this should get the user from DB and run pagespeed.create with that info
        $users = User::all();
        foreach ($users as $user){
            return view('pagespeed.create', [
                'user' => $user,
            ]);
        }

    }
}
