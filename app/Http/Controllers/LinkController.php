<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\Pagespeed;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
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
    public function create()
    {
        $user = auth()->user();
        $urls = Link::where('user_id', $user->id)->get();


        return view('link.create')->with(compact('user', 'urls'));
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
        return response()->redirectTo(route('link.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        /*
        if($request->days != "") {
            $days = $request->days;
        }
        else{
            $days = 30;
        }*/
        $days = 14;

        $user_id = auth()->user()->id;

        $pagespeedAvg['mobile_score'] = $this->averagePagespeed($link,'mobile_score', $days);
        $pagespeedAvg['mobile_speed'] = $this->averagePagespeed($link,'mobile_speed', $days);
        $pagespeedAvg['desktop_score'] = $this->averagePagespeed($link,'desktop_score', $days);
        $pagespeedAvg['desktop_speed'] = $this->averagePagespeed($link,'desktop_speed', $days);


        $data = $this->chartdata($link->id, $days);

        $datatable = Pagespeed::where('user_id', '=', $user_id )
            ->where('created_at', '>', now()->subDays($days)->endOfDay())
            ->get();

        return view('link.show')->with(compact('pagespeedAvg', 'data', 'days', 'datatable', 'link'));
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
