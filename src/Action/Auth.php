<?php

namespace SRC\Action;

use SRC\Common\Action;
use SRC\Common\Params;
use SRC\Common\Response;
use Slim\Http\Request;
use SRC\Service\Auth as AuthService;

class Auth extends Action
{
    protected $auth;
    protected $params = [
        'email' => ['type' => Params::STRING],
        'password' => ['type' => Params::STRING],
    ];

    /**
     * Auth constructor.
     * @param AuthService $auth
     */
    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    /**
        @api {post} /auth User Authentication
        @apiPermission apikey
        @apiVersion 1.0.0
        @apiName User Authentication
        @apiGroup Auth0
        @apiDescription User Authentication

        @apiParamExample {json} Input
        {
            "email": "user@domain.com",
            "password": "yourpassword"
        }

        @apiExample {shell} Curl
        curl "http://api-analytics.cloudwp.io/auth" \
        -X POST -H "Accept: application/json" \
        -H "X-CloudWP-Key: 0123456789abcdef0123456789abcdef" \
        -H "Cache-Control: no-cache"

        @apiSuccessExample {json} Success response
        {
            "message": "Bearer yourBearerToken"
        }
     **/
    public function post(Request $request, $response)
    {
        return Response::success($this->auth->getBearerToken($this->getParams($this,
            ['email' => ['type' => Params::STRING]])->email,
            $this->getParams($this, ['password' => ['type' => Params::STRING]])->password));
    }
}
