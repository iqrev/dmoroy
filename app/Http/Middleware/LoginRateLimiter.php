<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginRateLimiter
{
    public function __construct(protected RateLimiter $limiter) {}

    public function handle(Request $request, Closure $next): Response
    {
        // Hanya terapkan pada POST request ke login
        if ($request->isMethod('post')) {
            $key = 'login-attempt:' . $request->ip();
            $maxAttempts = 5;
            $decayMinutes = 5;

            if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
                $seconds = $this->limiter->availableIn($key);
                $minutes = ceil($seconds / 60);

                abort(429, "Terlalu banyak percobaan login. Silakan coba lagi dalam {$minutes} menit.");
            }

            $this->limiter->hit($key, $decayMinutes * 60);
        }

        return $next($request);
    }
}
