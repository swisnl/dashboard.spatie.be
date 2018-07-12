<?php

namespace App\Http\Controllers;

use Artisan;
use Illuminate\Routing\Controller;
use App\Services\TweetHistory\TweetHistory;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard')->with([
            'pusherKey' => config('broadcasting.connections.pusher.key'),

            'pusherCluster' => config('broadcasting.connections.pusher.options.cluster'),

            'initialTweets' => TweetHistory::all(),

            'usingNodeServer' => usingNodeServer(),
        ]);
    }

    public function update()
    {
        Artisan::call('dashboard:update');

        echo 'ok';
    }
}
