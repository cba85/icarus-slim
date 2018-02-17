<?php

namespace App\Middlewares;

/**
 * Example middleware
 */
Class ExampleMiddleware
{
    /**
     * Magic function __invoke
     * @param  Request $request
     * @param  Response $response
     * @param  string $next
     * @return mixed
     */
    public function __invoke($request, $response, $next) {
        return $next($request, $response);
    }

}
