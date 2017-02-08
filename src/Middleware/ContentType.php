<?php

namespace SRC\Middleware;


class ContentType
{
    public function __invoke($request, $response, $next)
    {
        $response = $next($request, $response);
        $headers = $response->getHeaders();
        if (empty($headers['Content-Type'])
            || (empty($headers['Content-Type'][0]) && strpos($headers['Content-Type'][0], 'text/html') === 0)
        ) {
            $response = $response->withHeader('Content-type', 'application/json');
        }
        return $response;
    }
}