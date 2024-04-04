<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\WeekMail;
use App\Http\Controllers\DomainController;

class MailController extends Controller
{
    public function index($user)
    {
        $pagespeed = $this->avgPagespeeds($user);
        $subject = 'Weekly Website Performance Report';

        Mail::to('sebastiaan36@gmail.com')->send(new WeekMail($subject, $user, $pagespeed));
        //return view('mail.weekmail')->with(compact('user', 'pagespeed'));
        }

        public function avgPagespeeds($user)
        {
            $data = array('mobile_speed', 'desktop_speed', 'mobile_score', 'desktop_score');

            foreach ($data as $d){
                foreach ($user->domains as $domain) {
                    $pagespeed[$domain->id]['domain'] = $domain->domain;
                    $pagespeed[$domain->id][$d]['new'] = DB::table('pagespeeds')
                        ->where('domain', $domain->id)
                        ->where('created_at', '>=', Carbon::now()->subDays(7))
                        ->avg($d);

                    $pagespeed[$domain->id][$d]['old'] = DB::table('pagespeeds')
                        ->where('domain', $domain->id)
                        ->whereBetween('created_at', [Carbon::now()->subDays(14), Carbon::now()->subDays(7)])
                        ->avg($d);

                    $pagespeed[$domain->id][$d]['change'] = $pagespeed[$domain->id][$d]['new'] - $pagespeed[$domain->id][$d]['old'];
                }
            }
            return $pagespeed;
        }

        public function SendMail(Request $request)
        {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required'
            ]);

            $data = array(
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message
            );

            Mail::to('info@been-vandam.nl')->send(new ContactForm($data));
            return redirect('/#contact')->with('success', 'Your email has been sent');
        }

}
