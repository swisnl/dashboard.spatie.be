<?php

namespace App\Console\Components\GameOfTests;

use App\GameOfTests\GameOfTests;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use App\Events\GameOfTests\TotalsFetched;

class FetchTotals extends Command
{
    protected $signature = 'dashboard:fetch-game-of-tests-totals';

    protected $description = 'Fetch totals from Game of Tests';

    public function handle()
    {
        $gameOfTests = new GameOfTests(new Client(), config('services.game-of-tests.base_url'));

        $totals = $gameOfTests->getTotals();

        event(new TotalsFetched($totals));
    }
}
