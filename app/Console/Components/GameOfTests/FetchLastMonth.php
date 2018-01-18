<?php

namespace App\Console\Components\GameOfTests;

use App\GameOfTests\GameOfTests;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use App\Events\GameOfTests\LastMonthFetched;

class FetchLastMonth extends Command
{
    protected $signature = 'dashboard:fetch-game-of-tests-last-month';

    protected $description = 'Fetch last month from Game of Tests';

    public function handle()
    {
        $gameOfTests = new GameOfTests(new Client(), config('services.game-of-tests.base_url'));

        $lastMonth = $gameOfTests->getLastMonth();

        event(new LastMonthFetched($lastMonth));
    }
}
