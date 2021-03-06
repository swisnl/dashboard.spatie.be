<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Components\Calendar\FetchCalendarEvents::class,
        \App\Console\Components\Service\FetchFeedback::class,
        \App\Console\Components\Fussbally\FetchStats::class,
        \App\Console\Components\GitHub\FetchTotals::class,
        \App\Console\Components\GitHub\FetchEventList::class,
        \App\Console\Components\InternetConnection\SendHeartbeat::class,
        \App\Console\Components\Npm\FetchTotals::class,
        \App\Console\Components\Music\FetchCurrentTrack::class,
        \App\Console\Components\Packagist\FetchTotals::class,
        \App\Console\Components\Tasks\FetchTasks::class,
        \App\Console\Components\Twitter\ListenForMentions::class,
        \App\Console\Components\Twitter\ListenForQuotes::class,
        \App\Console\Components\Twitter\SendFakeTweet::class,
        \App\Console\Components\GameOfTests\All::class,
        \App\Console\Components\GameOfTests\FetchTotals::class,
        \App\Console\Components\GameOfTests\FetchLastMonth::class,
        \App\Console\Components\GameOfTests\FetchTeams::class,
        UpdateDashboard::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('dashboard:send-heartbeat')->everyMinute();
        $schedule->command('dashboard:fetch-github-totals')->everyThirtyMinutes();
        $schedule->command('dashboard:fetch-github-events')->everyThirtyMinutes();
        $schedule->command('dashboard:fetch-packagist-totals')->hourly();
        $schedule->command('dashboard:fetch-npm-totals')->hourly();
        $schedule->command('dashboard:fetch-game-of-tests-all')->hourly();
        $schedule->command('dashboard:fetch-feedback')->hourly();
        $schedule->command('dashboard:fetch-fussbally')->everyFiveMinutes();
        $schedule->command('dashboard:fetch-calendar-events')->everyThirtyMinutes();
    }
}
