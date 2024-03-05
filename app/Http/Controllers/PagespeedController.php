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
    public function create($user)
    {
        //
        //create a new pagespeed data
            //$user = auth()->user();
                ini_set('max_execution_time', 180); //3 minutes
                $api = env('PAGESPEED_API');
                $domain = $user->domain;
                $urlmobile = 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=' . $domain . '&locale=nl-NL&strategy=mobile&key=' . $api;
                $urldesktop = 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=' . $domain . '&locale=nl-NL&strategy=desktop&key=' . $api;
        //        //dd($url); &fields=lighthouseResult&prettyPrint=false&%2Fcategories%2F*%2Fscore &category=performance
                $response = Http::timeout(-1)->get($urlmobile);
                $resultMobile = ($response->json());
                //dd($resultMobile);
                $response = Http::timeout(-1)->get($urldesktop);
                $resultDesktop = ($response->json());
               //mobile data
                $pagespeed['mobile_pagespeedscore'] = ($resultMobile['lighthouseResult']['categories']['performance']['score']) * 100;
                $pagespeed['mobile_pagespeed'] = round(($resultMobile['lighthouseResult']['audits']['speed-index']['numericValue']) / 1000, 2);
                //desktop data
                $pagespeed['desktop_pagespeedscore'] = ($resultDesktop['lighthouseResult']['categories']['performance']['score']) * 100;
                $pagespeed['desktop_pagespeed'] = round(($resultDesktop['lighthouseResult']['audits']['speed-index']['numericValue']) / 1000, 2);



        /*
        $pagespeed['mobile_pagespeedscore'] = 1;
        $pagespeed['mobile_pagespeed'] = 2;
        $pagespeed['desktop_pagespeedscore'] = 3;
        $pagespeed['desktop_pagespeed'] = 4;
        */

        $pagespeeddb = Pagespeed::create([
            'mobile_score'          =>  $pagespeed['mobile_pagespeedscore'],
            'desktop_score'         =>  $pagespeed['desktop_pagespeedscore'],
            'mobile_speed'          =>  $pagespeed['mobile_pagespeed'],
            'desktop_speed'         =>  $pagespeed['desktop_pagespeed'],
            'domain'                =>  $user->id,
            'user_id'               =>  $user->id,
            ]);

        //dd($pagespeeddb);
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
