<?php

namespace App\Http\Controllers;

use App\Plan;
use App\Http\Requests;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return view('plans.index')->with([
            'plans' => Plan::get(),
        ]);
    }

    public function show(Request $request, Plan $plan)
    {
        if ($request->user()->subscribedToPlan($plan->braintree_plan, 'main')) {
            return redirect()->route('home');
        }

        return view('plans.show')->with([
            'plan' => $plan,
        ]);
    }
}
