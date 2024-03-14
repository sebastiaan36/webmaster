<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Domain;



class Dashboard extends Controller
{
    public function index()
    {
        $domains = Domain::where('user_id', auth()->user()->id)->get();
        foreach ($domains as $domain){
            $count[$domain->id] = $domain->link()->count();
        }
        $links = Link::where('user_id', auth()->user()->id)->take(5)->get();
        return view('dashboard')->with(compact('domains', 'links', 'count'));
    }
}
