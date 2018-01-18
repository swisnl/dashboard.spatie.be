<?php

namespace App\Console\Components\GameOfTests;

use App\GameOfTests\GameOfTests;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use App\Events\GameOfTests\TeamsFetched;

class FetchTeams extends Command
{
    protected $signature = 'dashboard:fetch-game-of-tests-teams';

    protected $description = 'Fetch teams from Game of Tests';

    public function handle()
    {
        $gameOfTests = new GameOfTests(new Client(), config('services.game-of-tests.base_url'));

        $totals = $gameOfTests->getTeams();

        event(new TeamsFetched($totals));
    }
}
