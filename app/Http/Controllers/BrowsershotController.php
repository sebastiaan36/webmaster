<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

class BrowsershotController extends Controller
{
    //
    public function screenshot($domain){
        Browsershot::url($domain->domain)
            ->setOption('landscape', true)
            ->windowSize(1920, 1080)
            ->waitUntilNetworkIdle()
            ->setScreenshotType('jpeg')
            ->save(storage_path('/app/public/screenshots/' . $domain->id . '.jpeg'));

    }
}
