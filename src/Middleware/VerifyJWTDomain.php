<?php

namespace SRC\Middleware;

use SRC\Exception\DomainIsNotAllowedException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class VerifyJWTDomain
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $allowedDomains = $request->getAttribute('token')->app_metadata->domains;
        $domain = $request->getAttribute('route')->getArgument('sitename');

        if(!in_array($domain, $allowedDomains)) {
            throw new DomainIsNotAllowedException();
        }
        return $next($request, $response);
    }
}
