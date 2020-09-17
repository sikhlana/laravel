<?php

namespace App\Http\Middleware;

use Closure;
use League\StatsD\Laravel5\Facade\StatsdFacade;

class CountRequests
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $type
     * @return mixed
     */
    public function handle($request, Closure $next, $type = 'web')
    {
        StatsdFacade::increment('http.requests.'.$type);
        return $next($request);
    }
}
