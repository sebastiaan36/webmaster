<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $plans = config('cashier_plans.plans');

        return view('subscription.index')->with(compact('plans'));
    }

    public function subscribe($plan)
    {

        $user = auth()->user();
        $result = $user->newSubscription('main', $plan)->create();
        return view('dashboard');
    }
}
