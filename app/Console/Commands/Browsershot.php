<?php

namespace App\Console\Commands;

use App\Models\Domain;
use Illuminate\Console\Command;

class Browsershot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:browsershot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a screenshot of the homepage';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /*
        $this->info('Starting Browsershots');
        $domains = Domain::where('updated_at', '<', now()->subDays(-7))->limit(10)->get();
        $domainsCount = count($domains);
        $bar = $this->output->createProgressBar($domainsCount);
        $this->line('');
        $this->info('There are ' . $domainsCount . ' domains to check');
        $bar->start();
        foreach ($domains as $domain) {
            $this->line('' . $domain->domain . ' is being checked');
            $controller = new \App\Http\Controllers\BrowsershotController();
            $controller->screenshot($domain);
            $bar->advance();
            Domain::where('id', '=', $domain->id)->update(['updated_at' => now()]);
        }
        $bar->finish();
        */
    }
}
