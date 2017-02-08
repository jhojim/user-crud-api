<?php

namespace SRC\Service;

use Auth0\SDK\API\Authentication;

class Auth
{
    protected $credentials;

    /**
     * Auth constructor.
     * @param $credentials
     */
    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @param $email
     * @param $password
     * @return string
     */
    public function getBearerToken($email, $password)
    {
        $auth0Api = new Authentication($this->credentials['domain'], $this->credentials['client_id'],
            $this->credentials['client_secret']);

        $tokens = $auth0Api->authorize_with_ro($email, $password, $this->credentials['scope'],
            $this->credentials['connection']);

        return 'Bearer ' . $tokens['id_token'];
    }
}