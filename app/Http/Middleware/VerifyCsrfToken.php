<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
    ];

    public function handle($request, Closure $next)
    {
        if (
            parent::isReading($request) ||
            parent::runningUnitTests() ||
            parent::shouldPassThrough($request) ||
            parent::tokensMatch($request)
        ) {
            return parent::addCookieToResponse($request, $next($request));
        }

        return back()->with('error','The token has expired, please try again.');
    }
}
