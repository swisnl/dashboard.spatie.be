<?php

namespace App\Events\GameOfTests;

use App\Events\DashboardEvent;

class TotalsFetched extends DashboardEvent
{
    /** @var array */
    public $totals;

    public function __construct(array $totals)
    {
        $this->totals = $totals;
    }
}
