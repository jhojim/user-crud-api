<?php

namespace SRC\Action;

use SRC\CurrentUser;
use SRC\Common\Action;
use SRC\Common\Response;
use Slim\Http\Request;
use SRC\Service\Users as UsersService;

class User extends Action
{
    protected $usersService;
    protected $currentUser;

    /**
     * User constructor.
     * @param UsersService $usersService
     * @param CurrentUser $currentUser
     */
    public function __construct(UsersService $usersService, CurrentUser $currentUser)
    {
        $this->currentUser = $currentUser;
        $this->usersService = $usersService;
    }

    /**
        @api {get} /user Get User
        @apiPermission apikey
        @apiVersion 1.0.0
        @apiName GetUser
        @apiGroup User
        @apiDescription Returns user profile info

        @apiExample {shell} Curl
        curl "http://api-analytics.cloudwp.io/domain.com/user" \
        -X GET -H "Accept: application/json" \
        -H "X-CloudWP-Key: 0123456789abcdef0123456789abcdef" \
        -H "Authorization: Bearer jwt_token" \
        -H "Cache-Control: no-cache"

        @apiSuccessExample {json} Success response
        {
            "results": {
                "email": "user@domain.com",
                "domains": [
                    {
                        "domain": "domain.com",
                        "role_id": "1",
                        "role":
                        {
                            "name": "owner",
                            "manage_users": "1",
                            "manage_roles": "1",
                            "meta": []
                        },
                        "meta": [
                            {
                                "author": "owner"
                            },
                            {
                                "meta_name": "meta_value"
                            }
                        ]
                    },
                    {
                        "domain": "domain2.com",
                        "role_id": "2",
                        "role":
                        {
                            "name": "owner",
                            "manage_users": "1",
                            "manage_roles": "1",
                            "meta": ["post_id", "advertiser_id", "utm_content", "browser_family"]
                        },
                        "meta": []
                    },
                    {
                        "domain": "domain3.com",
                        "role_id": "3",
                        "role":
                        {
                            "name": "owner",
                            "manage_users": "1",
                            "manage_roles": "1",
                            "meta": []
                        },
                        "meta": [
                            {
                                "author": "owner"
                            },
                            {
                                "meta_name": "meta_value"
                            }
                        ]
                    }
                ]
            }
        }
     **/
    public function get(Request $request)
    {
        return Response::success($this->usersService->getByEmail($this->currentUser->getEmail()));
    }

}