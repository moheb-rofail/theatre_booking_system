<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     * 
     * API routes are excluded because we use token-based authentication (Bearer tokens)
     * instead of session-based authentication. CSRF protection is only needed for
     * stateful (session-based) authentication, not for stateless token-based APIs.
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/*', // All API routes are excluded from CSRF verification
    ];
}
