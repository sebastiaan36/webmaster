<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class Dashboard extends Controller
{
    public function index(Request $request){

        if($request->days != "") {
            $days = $request->days;
        }
        else{
            $days = 30;
        }

        $user_id = auth()->user()->id;

        $pagespeedAvg['mobile_score'] = $this->averagePagespeed($user_id,'mobile_score', $days);
        $pagespeedAvg['mobile_speed'] = $this->averagePagespeed($user_id,'mobile_speed', $days);
        $pagespeedAvg['desktop_score'] = $this->averagePagespeed($user_id,'desktop_score', $days);
        $pagespeedAvg['desktop_speed'] = $this->averagePagespeed($user_id,'desktop_speed', $days);

        $data = $this->chartdata($user_id, $days);

        $datatable = DB::table('pagespeeds')
            ->where('user_id', '=', $user_id )
            ->where('created_at', '>', now()->subDays($days)->endOfDay())
            ->get();

        return view('dashboard')->with(compact('pagespeedAvg', 'data', 'days', 'datatable'));
    }

    function averagePagespeed($user, $column, $days){

        $pagespeedAvg = DB::table('pagespeeds')
            ->where('user_id', '=', $user )
            ->where('created_at', '>', now()->subDays($days)->endOfDay())
            ->avg($column);

        return $pagespeedAvg;
    }

    function chartdata($user, $days){

        $columns = array('mobile_score', 'desktop_score', 'mobile_speed', 'desktop_speed');
        foreach ($columns as $column) {
            $dataDB = DB::table('pagespeeds')
                ->where('user_id', "=", $user)
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
