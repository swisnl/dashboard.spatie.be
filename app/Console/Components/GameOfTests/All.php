<?php

namespace App\Console\Components\GameOfTests;

use Illuminate\Console\Command;

class All extends Command
{
    protected $signature = 'dashboard:fetch-game-of-tests-all';

    protected $description = 'Fetch all data from Game of Tests';

    public function handle()
    {
        $this->call('dashboard:fetch-game-of-tests-totals');
        $this->call('dashboard:fetch-game-of-tests-last-month');
        $this->call('dashboard:fetch-game-of-tests-teams');
    }
}
