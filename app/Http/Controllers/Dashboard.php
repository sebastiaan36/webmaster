<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Domain;
use App\Models\Cashier\Subscription;



class Dashboard extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $domains = Domain::where('user_id', auth()->user()->id)->get();
        if($domains->isEmpty()){
            $domains = array();
            $count = "";
            $pagespeed = array();
            $graph = array();

        }

        //$links = Link::where('domain', ;
        foreach ($domains as $domain){
            $count[$domain->id] = $domain->link()->count();
            //get the avarage pagespeed score for the first link of this user over the past 7 days
            $pagespeed[$domain->id]['mobile_score'] = DB::table('pagespeeds')
                ->where('domain', $domain->id)
                ->where('created_at', '>=', Carbon::now()->subDays(7))
                ->avg('mobile_score');
            $pagespeed[$domain->id]['desktop_score'] = DB::table('pagespeeds')
                ->where('domain', $domain->id)
                ->where('created_at', '>=', Carbon::now()->subDays(7))
                ->avg('desktop_score');
            $pagespeed[$domain->id]['mobile_speed'] = DB::table('pagespeeds')
                ->where('domain', $domain->id)
                ->where('created_at', '>=', Carbon::now()->subDays(7))
                ->avg('mobile_speed');
            $pagespeed[$domain->id]['desktop_speed'] = DB::table('pagespeeds')
                ->where('domain', $domain->id)
                ->where('created_at', '>=', Carbon::now()->subDays(7))
                ->avg('desktop_speed');

            //get the avarage pagespeed['desktop_speed'] for the last 7 days grouped by day
            $pagespeed[$domain->id]['desktop_days'] = DB::table('pagespeeds')
                ->where('domain', $domain->id)
                ->where('created_at', '>=', Carbon::now()->subDays(7))
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('AVG(desktop_speed) as desktop_speed'))
                ->groupBy('date')
                ->get();
            foreach ($pagespeed[$domain->id]['desktop_days'] as $day){
                $graph[$domain->id]['desktop_days']['labels'][] = $day->date;
                $graph[$domain->id]['desktop_days']['data'][] = round($day->desktop_speed,2);
            }

            $pagespeed[$domain->id]['mobile_days'] = DB::table('pagespeeds')
                ->where('domain', $domain->id)
                ->where('created_at', '>=', Carbon::now()->subDays(7))
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('AVG(mobile_speed) as mobile_speed'))
                ->groupBy('date')
                ->get();
            foreach ($pagespeed[$domain->id]['mobile_days'] as $day){
                $graph[$domain->id]['mobile_days']['labels'][] = $day->date;
                $graph[$domain->id]['mobile_days']['data'][] = round($day->mobile_speed,2);
            }

            $pagespeed[$domain->id]['need_work'] = DB::table('pagespeeds')
                ->where('domain', $domain->id)
                ->where('mobile_score', '<', 50)
                ->whereDate('created_at', Carbon::today())->get();
                //->countBy('link')->count();
              }


        return view('dashboard')->with(compact('domains', 'count', 'pagespeed', 'graph'));
    }
}
