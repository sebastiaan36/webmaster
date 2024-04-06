<?php

namespace App\Http\Controllers;

use App\Models\Pagespeed;
use App\Http\Requests\StorePagespeedRequest;
use App\Http\Requests\UpdatePagespeedRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PagespeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($url)
    {


        //set max time to run script to 6min.
        ini_set('max_execution_time', 360); //6 minutes

        //get google api key from .env
        $api = env('PAGESPEED_API');

        //get domain from user
         $domain = $url->url;
       // $domain = 'https://been-vandam.nl';
        //if ($this->check404($domain) === false) {

            //pagespeed api calls
            $urlmobile = 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=' . $domain . '&locale=en-EN&strategy=mobile&key=' . $api;
            $urldesktop = 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=' . $domain . '&locale=en-EN&strategy=desktop&key=' . $api;

            $response = Http::timeout(-1)->get($urlmobile);
            $resultMobile = ($response->json());

            $response = Http::timeout(-1)->get($urldesktop);
            $resultDesktop = ($response->json());



            if (array_key_exists('lighthouseResult', $resultMobile) === true && array_key_exists('lighthouseResult', $resultDesktop) === true) {
                //mobile data
                $pagespeed['mobile_pagespeedscore']     = isset($resultMobile['lighthouseResult']['categories']['performance']['score']) ? ($resultMobile['lighthouseResult']['categories']['performance']['score']) * 100 : 0;
                $pagespeed['mobile_pagespeed']          = isset($resultMobile['lighthouseResult']['audits']['speed-index']['numericValue']) ? round(($resultMobile['lighthouseResult']['audits']['speed-index']['numericValue']) / 1000, 2) : 0;
                $pagespeed['FCP_mobile']                = isset($resultMobile['lighthouseResult']['audits']['first-contentful-paint']['numericValue']) ? round(($resultMobile['lighthouseResult']['audits']['first-contentful-paint']['numericValue']) / 1000, 2) : 0;
                $pagespeed['LCP_mobile']                = isset($resultMobile['lighthouseResult']['audits']['largest-contentful-paint']['numericValue']) ? round(($resultMobile['lighthouseResult']['audits']['largest-contentful-paint']['numericValue']) / 1000, 2) : 0;
                $pagespeed['CLS_mobile']                = isset($resultMobile['lighthouseResult']['audits']['cumulative-layout-shift']['numericValue']) ? round($resultMobile['lighthouseResult']['audits']['cumulative-layout-shift']['numericValue'], 4) : 0;
                $pagespeed['TBT_mobile']                = isset($resultMobile['lighthouseResult']['audits']['total-blocking-time']['numericValue']) ? round(($resultMobile['lighthouseResult']['audits']['total-blocking-time']['numericValue']) / 1000, 2) : 0;
                $pagespeed['TTI_mobile']                = isset($resultMobile['lighthouseResult']['audits']['interactive']['numericValue']) ? round(($resultMobile['lighthouseResult']['audits']['interactive']['numericValue']) / 1000, 2) : 0;
                $pagespeed['size_mobile']               = isset($resultMobile['lighthouseResult']['audits']['total-byte-weight']['numericValue']) ? round(($resultMobile['lighthouseResult']['audits']['total-byte-weight']['numericValue']) / 1000000, 2) : 0;


                //desktop data
                //change desktop data to 0 if it does not exist

                $pagespeed['desktop_pagespeedscore']    = isset($resultDesktop['lighthouseResult']['categories']['performance']['score']) ? ($resultDesktop['lighthouseResult']['categories']['performance']['score']) * 100 : 0;
                $pagespeed['desktop_pagespeed']         = isset($resultDesktop['lighthouseResult']['audits']['speed-index']['numericValue']) ? round(($resultDesktop['lighthouseResult']['audits']['speed-index']['numericValue']) / 1000, 2) : 0;
                $pagespeed['FCP_desktop']               = isset($resultDesktop['lighthouseResult']['audits']['first-contentful-paint']['numericValue']) ? round(($resultDesktop['lighthouseResult']['audits']['first-contentful-paint']['numericValue']) / 1000, 2) : 0;
                $pagespeed['LCP_desktop']               = isset($resultDesktop['lighthouseResult']['audits']['largest-contentful-paint']['numericValue']) ? round(($resultDesktop['lighthouseResult']['audits']['largest-contentful-paint']['numericValue']) / 1000, 2) : 0;
                $pagespeed['CLS_desktop']               = isset($resultDesktop['lighthouseResult']['audits']['cumulative-layout-shift']['numericValue']) ? round($resultDesktop['lighthouseResult']['audits']['cumulative-layout-shift']['numericValue'], 4) : 0;
                $pagespeed['TBT_desktop']               = isset($resultDesktop['lighthouseResult']['audits']['total-blocking-time']['numericValue']) ? round(($resultDesktop['lighthouseResult']['audits']['total-blocking-time']['numericValue']) / 1000, 2) : 0;
                $pagespeed['TTI_desktop']               = isset($resultDesktop['lighthouseResult']['audits']['interactive']['numericValue']) ? round(($resultDesktop['lighthouseResult']['audits']['interactive']['numericValue']) / 1000, 2) : 0;
                $pagespeed['size_desktop']              = isset($resultDesktop['lighthouseResult']['audits']['total-byte-weight']['numericValue']) ? round(($resultDesktop['lighthouseResult']['audits']['total-byte-weight']['numericValue']) / 1000000, 2) : 0;


                //save data to database
                $pagespeeddb = Pagespeed::create([
                    'mobile_score'      => $pagespeed['mobile_pagespeedscore'],
                    'desktop_score'     => $pagespeed['desktop_pagespeedscore'],
                    'mobile_speed'      => $pagespeed['mobile_pagespeed'],
                    'desktop_speed'     => $pagespeed['desktop_pagespeed'],
                    'FCP_mobile'        => $pagespeed['FCP_mobile'],
                    'LCP_mobile'        => $pagespeed['LCP_mobile'],
                    'CLS_mobile'        => $pagespeed['CLS_mobile'],
                    'TBT_mobile'        => $pagespeed['TBT_mobile'],
                    'TTI_mobile'        => $pagespeed['TTI_mobile'],
                    'size_mobile'       => $pagespeed['size_mobile'],

                    'FCP_desktop'       => $pagespeed['FCP_desktop'],
                    'LCP_desktop'       => $pagespeed['LCP_desktop'],
                    'CLS_desktop'       => $pagespeed['CLS_desktop'],
                    'TBT_desktop'       => $pagespeed['TBT_desktop'],
                    'TTI_desktop'       => $pagespeed['TTI_desktop'],
                    'size_desktop'      => $pagespeed['size_desktop'],

                    'domain'            => $url->domain,
                    'user_id'           => $url->user_id,
                    'link'              => $url->id,
                ]);
                return ($pagespeeddb);
            } else {
                Log::error("Pagespeed returned an error for: $domain");
                unset($resultMobile, $resultDesktop, $pagespeeddb);
                return ('there was an error');
            }

        /* } else {
             //log an error message to laravel with the url that returned a 404
             Log::error("URL returned 404 for: $domain");
             unset($resultMobile, $resultDesktop, $pagespeeddb);
             return ('there was an error');
 
         }*/
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePagespeedRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pagespeed $pagespeed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pagespeed $pagespeed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePagespeedRequest $request, Pagespeed $pagespeed)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pagespeed $pagespeed)
    {
        //
    }

    public function check404($url)
    {
        $headers = get_headers($url, 1);
        if ($headers[0] != 'HTTP/1.1 200 OK') return true; else return false;
    }

    public function exists($array, $key)
    {
        $var = $array[$key] ?? false;
        return $var;
    }
}
