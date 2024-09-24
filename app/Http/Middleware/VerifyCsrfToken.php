<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken
{
    private $except;

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws TokenMismatchException
     */

    public function handle($request, Closure $next)
    {
        // Пропустити запити для GET, HEAD, OPTIONS
        if ($this->isReading($request) || $this->runningUnitTests() || $this->inExceptArray($request)) {
            return $next($request);
        }

        // Перевірка CSRF токена
        if ($request->session()->token() !== $request->input('_token') && $request->session()->token() !== $request->header('X-CSRF-TOKEN')) {
            throw new TokenMismatchException;
        }

        return $next($request);
    }

    protected function inExceptArray($request)
    {
        foreach ($this->except as $except) {
            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }

    protected function isReading($request): bool
    {
        return in_array($request->method(), ['HEAD', 'OPTIONS']);
    }

    protected function runningUnitTests()
    {
        return app()->runningUnitTests();
    }
}
