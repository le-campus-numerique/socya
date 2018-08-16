<?php

namespace App\Http\Controllers;

use App\Newsletter;
use App\Subscription;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        $user->load('role')
            ->load('subscriptions');
        $newletter = Newsletter::latest()->first();
        $subCount = Subscription::all()->where('date_start','>', Carbon::now()->subYear()
            ->format('Y-m-d'))->count();

        return view('home', ['user' => $user, 'newsletter' => $newletter, 'subCount' => $subCount]);
    }

}
