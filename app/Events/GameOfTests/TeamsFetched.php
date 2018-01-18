<?php

namespace App\Events\GameOfTests;

use App\Events\DashboardEvent;

class TeamsFetched extends DashboardEvent
{
    /** @var array */
    public $teams;

    public function __construct(array $teams)
    {
        $this->teams = $teams;
    }
}
