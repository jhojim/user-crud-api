<?php

namespace SRC;

use SRC\Exception\UnauthorizedRequestException;
use Slim\Middleware\JwtAuthentication;

class JwtAuthenticationFactory
{
    protected $token;
    public function __construct($token)
    {
        $this->token = $token;
    }

    public function createJwtAuthentication()
    {
        return new JwtAuthentication([
            'secret' => \Firebase\JWT\JWT::urlsafeB64Decode($this->token),
            'secure' => false,
            'error' => function ($request, $response, $arguments) {
                throw new UnauthorizedRequestException($arguments['message'], 401);
            }
        ]);
    }
}