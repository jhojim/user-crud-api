<?php

namespace SRC;

use Auth0\SDK\API\Management;
use Auth0\SDK\API\Authentication;

class Auth0
{

    protected $auth0management;

    public function __construct($credentials)
    {
        $auth = new Authentication($credentials['domain']);
        $auth0token = $auth->oauth_token($credentials['client_id'], $credentials['client_secret'],
            'client_credentials',
            null,
            "https://" . $credentials['domain'] . "/api/v2/")['access_token'];
        $this->auth0management = new Management($auth0token, $credentials['domain']);
    }

    public function checkUserExist($email)
    {
        return !empty($this->getUser($email));
    }

    public function getUser($email)
    {
        return $this->auth0management->users->search(['q' => 'email="' . $email . '"']);
    }

    public function createUser($email, $password)
    {
        return !empty($this->auth0management->users->create([
            'connection' => 'Username-Password-Authentication',
            'email' => $email,
            'password' => $password,
            'app_metadata' => ['user_email'=>$email]
        ]));
    }

    public function updateUser($email, $password)
    {
        $user_id = $this->getUser($email)[0]['user_id'];
        return !empty($this->auth0management->users->update($user_id, [
            'password' => $password
        ]));
    }

    public function deleteUser($email)
    {
        $user_id = $this->getUser($email)[0]['user_id'];
        return !empty($this->auth0management->users->delete($user_id));
    }

}