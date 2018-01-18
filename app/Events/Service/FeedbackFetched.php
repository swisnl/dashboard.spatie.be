<?php

namespace App\Events\Service;

use App\Events\DashboardEvent;

class FeedbackFetched extends DashboardEvent
{

    public $tevreden = 0;
    public $ontevreden = 0;
    public $neutraal = 0;

    public function __construct(array $feedback)
    {
        foreach ($feedback as $sumName => $total) {
            $this->$sumName = $total;
        }
    }
}
