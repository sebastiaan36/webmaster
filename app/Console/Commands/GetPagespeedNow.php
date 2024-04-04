<?php

namespace App\Console\Commands;

use App\Models\Link;
use Illuminate\Console\Command;

class GetPagespeedNow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Pagespeed:GetPagespeedNow';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Pagespeed when uploading';

    /**
     * Execute the console command.
     */
    public function handle($links)
    {
        if($links) {
            $controller = new \App\Http\Controllers\PagespeedController();
            $result = $controller->create($links);
            if ($result) {
                Link::where('id', '=', $links->id)->update(['url' => $links->url]);
            }
        }
    }
}
