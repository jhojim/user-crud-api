<?php

namespace SRC\Middleware;

use SRC\CurrentUser;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class VerifyUser
{
    protected $currentUser;

    public function __construct(CurrentUser $currentUser)
    {
        $this->currentUser = $currentUser;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $this->currentUser->initialize($request->getAttribute('token')->email,
            $request->getAttribute('route')->getArgument('sitename'));
        return $next($request, $response);
    }
}
