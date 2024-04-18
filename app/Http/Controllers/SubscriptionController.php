<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\SubscriptionBuilder\RedirectToCheckoutResponse;

class SubscriptionController extends Controller
{
    public function index()
    {
        $plans = config('cashier_plans.plans');

        return view('subscription.index')->with(compact('plans'));
    }

    public function subscribe($plan)
    {

        $user = Auth::user();
        //dd($plan);
        $name = ucfirst($plan);

        if(!$user->subscribed($name, $plan)) {

            $result = $user->newSubscription($name, $plan)->create();

            if(is_a($result, RedirectToCheckoutResponse::class)) {
                //return $result->payment()->getCheckoutUrl();
                return $result; // Redirect to Mollie checkout
            }

            return back()->with('status', 'Welcome to the ' . $plan . ' plan');
        }

        return back()->with('status', 'You are already on the ' . $plan . ' plan');
    }

    public function success()
    {
        return view('subscription.success');
    }
}
