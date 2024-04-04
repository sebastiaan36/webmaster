<?php


namespace App\Console\Commands;

use App\Models\Link;
use App\Models\Pagespeed;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GetPagespeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Pagespeed:GetPagespeed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all the pagespeed results';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to get links');
        $links = Link::where('updated_at', '<', Carbon::today()->toDateString())->limit(10)->get();

        //get the amount of rows $links got from the database
        $linksCount = count($links);
        //start the progressbar with $linkcount amount of steps
        $bar = $this->output->createProgressBar($linksCount);
        $this->line('');
        $this->info('There are ' . $linksCount . ' links to check');

        if ($links) {
            $bar->start();

            foreach ($links as $link) {
                $this->info('testing link:' . $link->url);
                $controller = new \App\Http\Controllers\PagespeedController();
                $result = $controller->create($link);
                if ($result) {
                    Link::where('id', '=', $link->id)->update(['url' => $link->url]);
                }
                $bar->advance();
            }
            $bar->finish();
        }
    }
}
