<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Link;
use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use Illuminate\Http\Request;
use App\Models\Pagespeed;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Domain $domain)
    {
        //
        $links = Link::where('domain', $domain->id)->get();

        foreach ($links as $link){

            $pagespeeds = Pagespeed::where('link', $link->id)->latest()->first();
            $link->pagespeeds = $pagespeeds;
        }



        return view('domain.link.index')->with(compact('links', 'domain'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($domain_id)
    {
        $user = auth()->user();
        $urls = Link::where('domain', $domain_id)->get();
        $domain = Domain::where('id', $domain_id)->first();

        return view('domain.link.create')->with(compact('user', 'urls', 'domain'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLinkRequest $request)
    {
        $url = $request->domain . "/" . $request->url;
        //dd($request);
        $links = Link::create([
            'url'           =>      $url,
            'user_id'       =>      auth()->user()->id,
            'domain'        =>      auth()->user()->id,

        ]);
        return response()->redirectTo(route('domain.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Domain $domain, Link $link, Request $request)
    {

        if($request->days != "") {
            $days = $request->days;
        }
        else{
            $days = 14;
        }
        //$days = 14;

        $user_id = auth()->user()->id;

        $pagespeedAvg['mobile_score'] = $this->averagePagespeed($link,'mobile_score', $days);
        $pagespeedAvg['mobile_speed'] = $this->averagePagespeed($link,'mobile_speed', $days);
        $pagespeedAvg['desktop_score'] = $this->averagePagespeed($link,'desktop_score', $days);
        $pagespeedAvg['desktop_speed'] = $this->averagePagespeed($link,'desktop_speed', $days);


        $data = $this->chartdata($link->id, $days);

        $datatable = Pagespeed::where('link', '=', $link->id )
            ->where('created_at', '>', now()->subDays($days)->endOfDay())
            ->get();

        return view('domain.link.show')->with(compact('pagespeedAvg', 'data', 'days', 'datatable', 'link'));
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLinkRequest $request, Link $link)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        //
    }

    function averagePagespeed($link, $column, $days){

        $pagespeedAvg = Pagespeed::
            where('link', '=', $link->id )
            ->where('created_at', '>', now()->subDays($days)->endOfDay())
            ->avg($column);

        return $pagespeedAvg;
    }

    function chartdata($link, $days){
        $data = array();
        $columns = array('mobile_score', 'desktop_score', 'mobile_speed', 'desktop_speed');
        foreach ($columns as $column) {
            $dataDB = Pagespeed::where('link', "=", $link)
                ->where('created_at', '>', now()->subDays($days)->endOfDay())
                ->pluck($column, 'created_at');

            foreach ($dataDB as $key => $value) {
                $data[$column]['labels'][] = Carbon::createFromFormat('Y-m-d H:i:s', $key)
                    ->format('d-m-Y');
                $data[$column]['data'][] = $value;
            }
        }
        return $data;
    }
}
