<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Link;
use App\Http\Requests\StoreDomainRequest;
use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateDomainRequest;
use Carbon\Carbon;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $links = array();
        $user_id = auth()->user()->id;
        $domains = auth()->user()->domains()->get();

        foreach ($domains as $domain){
            $links[] = $domain->link()->get();
        }

        //if domains has only one domain return the links index view

            return view('domain.index')->with(compact('domains', 'links'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id = auth()->user()->id;

        $domains =  Domain::where('user_id', $user_id)->get();
        return view('domain.create')->with(compact('domains'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDomainRequest $request)
    {
        //
        $url = $request->domain;

        $domains = Domain::create([
            'user_id'   =>      auth()->user()->id,
            'domain'    =>      $url,


        ]);
        $links = Link::create([
            'url'       =>      $url,
            'user_id'   =>      auth()->user()->id,
            'domain'    =>      $domains->id,
            'updated_at' =>     Carbon::now()->subDays(1),

        ]);
        return redirect()->route('domain.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Domain $domain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Domain $domain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDomainRequest $request, Domain $domain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Domain $domain)
    {
        //
    }


}
