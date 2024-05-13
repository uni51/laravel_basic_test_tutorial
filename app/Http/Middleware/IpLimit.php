<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IpLimit
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->runningUnitTests()) {
            return $next($request);
        }

        if (! in_array($request->ip(), ['10.0.0.1'], true)) {
            abort(403, 'Your IP is not valid.');
        }

        return $next($request);
    }

    protected function runningUnitTests()
    {
        return app()->runningInConsole() && app()->runningUnitTests();
    }
}
