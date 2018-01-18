<?php

namespace App\Events\GameOfTests;

use App\Events\DashboardEvent;

class LastMonthFetched extends DashboardEvent
{
    /** @var array */
    public $month;

    public function __construct(array $month)
    {
        $this->month = $month;
    }
}
