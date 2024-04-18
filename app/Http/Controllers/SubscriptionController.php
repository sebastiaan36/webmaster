<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $name = ucfirst($plan) . ' membership';

        if(!$user->subscribed($name, $plan)) {

            $result = $user->newSubscription($name, $plan)->create();

            if(is_a($result, RedirectToCheckoutResponse::class)) {
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
