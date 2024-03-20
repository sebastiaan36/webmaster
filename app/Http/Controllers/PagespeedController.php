<?php

namespace App\Http\Controllers;

use App\Models\Pagespeed;
use App\Http\Requests\StorePagespeedRequest;
use App\Http\Requests\UpdatePagespeedRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

                //pagespeed api calls
                $urlmobile = 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=' . $domain . '&locale=en-EN&strategy=mobile&key=' . $api;
                $urldesktop = 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=' . $domain . '&locale=en-EN&strategy=desktop&key=' . $api;

                $response = Http::timeout(-1)->get($urlmobile);
                $resultMobile = ($response->json());

                $response = Http::timeout(-1)->get($urldesktop);
                $resultDesktop = ($response->json());

                //pagespeed api results to array
                //mobile data
                $pagespeed['mobile_pagespeedscore'] = ($resultMobile['lighthouseResult']['categories']['performance']['score']) * 100;
                $pagespeed['mobile_pagespeed'] = round(($resultMobile['lighthouseResult']['audits']['speed-index']['numericValue']) / 1000, 2);
                $pagespeed['FCP_mobile'] = round(($resultMobile['lighthouseResult']['audits']['first-contentful-paint']['numericValue']) / 1000, 2);
                $pagespeed['LCP_mobile'] = round(($resultMobile['lighthouseResult']['audits']['largest-contentful-paint']['numericValue']) / 1000, 2);
                $pagespeed['CLS_mobile'] = round($resultMobile['lighthouseResult']['audits']['cumulative-layout-shift']['numericValue'],4);
                $pagespeed['TBT_mobile'] = round(($resultMobile['lighthouseResult']['audits']['total-blocking-time']['numericValue']) / 1000, 2);
                $pagespeed['TTI_mobile'] = round(($resultMobile['lighthouseResult']['audits']['interactive']['numericValue']) / 1000, 2);
                $pagespeed['size_mobile'] = round(($resultMobile['lighthouseResult']['audits']['total-byte-weight']['numericValue']) / 1000000, 2);


                //desktop data
                $pagespeed['desktop_pagespeedscore'] = ($resultDesktop['lighthouseResult']['categories']['performance']['score']) * 100;
                $pagespeed['desktop_pagespeed'] = round(($resultDesktop['lighthouseResult']['audits']['speed-index']['numericValue']) / 1000, 2);
                $pagespeed['FCP_desktop'] = round(($resultDesktop['lighthouseResult']['audits']['first-contentful-paint']['numericValue']) / 1000, 2);
                $pagespeed['LCP_desktop'] = round(($resultDesktop['lighthouseResult']['audits']['largest-contentful-paint']['numericValue']) / 1000, 2);
                $pagespeed['CLS_desktop'] = round($resultDesktop['lighthouseResult']['audits']['cumulative-layout-shift']['numericValue'],4);
                $pagespeed['TBT_desktop'] = round(($resultDesktop['lighthouseResult']['audits']['total-blocking-time']['numericValue']) / 1000, 2);
                $pagespeed['TTI_desktop'] = round(($resultDesktop['lighthouseResult']['audits']['interactive']['numericValue']) / 1000, 2);
                $pagespeed['size_desktop'] = round(($resultDesktop['lighthouseResult']['audits']['total-byte-weight']['numericValue']) / 1000000, 2);


                //save data to database
                $pagespeeddb = Pagespeed::create([
                    'mobile_score'          =>  $pagespeed['mobile_pagespeedscore'],
                    'desktop_score'         =>  $pagespeed['desktop_pagespeedscore'],
                    'mobile_speed'          =>  $pagespeed['mobile_pagespeed'],
                    'desktop_speed'         =>  $pagespeed['desktop_pagespeed'],
                    'FCP_mobile'            =>  $pagespeed['FCP_mobile'],
                    'LCP_mobile'            =>  $pagespeed['LCP_mobile'],
                    'CLS_mobile'            =>  $pagespeed['CLS_mobile'],
                    'TBT_mobile'            =>  $pagespeed['TBT_mobile'],
                    'TTI_mobile'            =>  $pagespeed['TTI_mobile'],
                    'size_mobile'           =>  $pagespeed['size_mobile'],

                    'FCP_desktop'           =>  $pagespeed['FCP_desktop'],
                    'LCP_desktop'           =>  $pagespeed['LCP_desktop'],
                    'CLS_desktop'           =>  $pagespeed['CLS_desktop'],
                    'TBT_desktop'           =>  $pagespeed['TBT_desktop'],
                    'TTI_desktop'           =>  $pagespeed['TTI_desktop'],
                    'size_desktop'          =>  $pagespeed['size_desktop'],

                    'domain'                =>  $url->domain,
                    'user_id'               =>  $url->user_id,
                    'link'                  =>  $url->id,
                    ]);
                return ($pagespeeddb);
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
}
