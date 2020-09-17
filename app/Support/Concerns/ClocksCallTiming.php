<?php

namespace App\Support\Concerns;

use League\StatsD\Laravel5\Facade\StatsdFacade;

trait ClocksCallTiming
{
    protected function clock(string $name, callable $callback)
    {
        $timer = StatsdFacade::startTiming($name);
        $return = call_user_func($callback);
        $timer->endTiming($name);

        return $return;
    }
}
