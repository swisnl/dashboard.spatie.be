<?php

namespace App\Events\GitHub;

use App\Events\DashboardEvent;
use Illuminate\Support\Collection;

class EventsFetched extends DashboardEvent
{
    /** @var Collection */
    public $events;

    public function __construct(Collection $events)
    {
        $this->events = $events;
    }
}
