<?php

namespace SRC\Action;

use SRC\Auth0;

use SRC\Common\Action;
use SRC\Common\Params;
use SRC\Common\Response;
use Slim\Http\Request;
use SRC\Service\Users as UsersService;

class Users extends Action
{
    protected $auth0;
    protected $usersService;
    protected $params = [
        'email' => ['type' => Params::STRING],
        'meta' => ['type' => Params::ARR, 'default' => []],
        'role_id' => ['type' => Params::NUMBER],
    ];

    /**
     * Users constructor.
     * @param UsersService $usersService
     * @param Auth0 $auth0
     */
    public function __construct(
        UsersService $usersService,
        Auth0 $auth0
    ) {
        $this->usersService = $usersService;
        $this->auth0 = $auth0;
    }

    /**
        @api {get} /:domain/users Get Users
        @apiPermission apikey
        @apiVersion 1.0.0
        @apiName GetUsers
        @apiGroup Users
        @apiDescription Returns all users with permissions for domain

        @apiExample {shell} Curl
        curl "http://api-analytics.cloudwp.io/domain.com/users" \
        -X GET -H "Accept: application/json" \
        -H "X-CloudWP-Key: 0123456789abcdef0123456789abcdef" \
        -H "Authorization: Bearer jwt_token" \
        -H "Cache-Control: no-cache"

        @apiSuccessExample {json} Success response
         {
             "results":
            {
                "email": "user@domain.com",
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
                "email": "user2@domain.com",
                "role_id": "2",
                "role":
                {
                    "name": "owner",
                    "manage_users": "1",
                    "manage_roles": "1",
                    "meta": []
                },
                "meta": []
            },
            {
                "email": "user3@domain.com",
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
                        "author": "admin"
                    },
                    {
                        "meta_name": "meta_value"
                    }
                ]
            }
        }
     **/
    public function get(Request $request, $response, $args)
    {
        return Response::success($this->usersService->getByDomain($args['sitename']));
    }

    /**
        @api {post} /:domain/users Create User
        @apiPermission apikey
        @apiVersion 1.0.0
        @apiName CreateUser
        @apiGroup Users
        @apiDescription Create user for domain

        @apiParamExample {json} Input
        {
            "email": "user@domain.com",
            "role_id": "1",
            "meta": [
                {
                    "author": "admin"
                },
                {
                    "meta_name": "meta_value"
                }
            ]
        }

        @apiExample {shell} Curl
        curl "http://api-analytics.cloudwp.io/domain.com/users" \
        -X POST -H "Accept: application/json" \
        -H "X-CloudWP-Key: 0123456789abcdef0123456789abcdef" \
        -H "Authorization: Bearer jwt_token" \
        -H "Cache-Control: no-cache"

        @apiSuccessExample {json} Success response
        {
            "results":
            {
                "email": "user@domain.com",
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
            }
        }
     **/
    public function post(Request $request, $response, $args)
    {
        return Response::success($this->usersService->create(
            $this->getParams($this, ['email' => ['type' => Params::STRING]])->email,
            $this->getParams($this, ['meta' => ['type' => Params::ARR]])->meta,
            $this->getParams($this, ['role_id' => ['type' => Params::STRING]])->role_id, $args['sitename']));
    }

     /**
        @api {put} /:domain/users Edit User
        @apiPermission apikey
        @apiVersion 1.0.0
        @apiName EditUser
        @apiGroup Users
        @apiDescription Edit user for domain

        @apiParamExample {json} Input
        {
            "email": "user@domain.com",
            "role_id": "1",
            "meta": [
                {
                    "author": "admin"
                },
                {
                    "meta_name": "meta_value"
                }
            ]
        }

        @apiExample {shell} Curl
        curl "http://api-analytics.cloudwp.io/domain.com/users" \
        -X PUT -H "Accept: application/json" \
        -H "X-CloudWP-Key: 0123456789abcdef0123456789abcdef" \
        -H "Authorization: Bearer jwt_token" \
        -H "Cache-Control: no-cache"

        @apiSuccessExample {json} Success response
        {
            "results":
            {
                "email": "user@domain.com",
                "domain": "domain.com",
                "role_id": "1",
                "role":
                {
                    "name": "owner",
                    "manage_users": "1",
                    "manage_roles": "1",
                    "meta": ["post_id", "advertiser_id", "utm_content", "browser_family"]
                },
                "meta": [
                    {
                        "author": "admin"
                    },
                    {
                        "meta_name": "meta_value2"
                    }
                ]
            }
        }
      **/
    public function put(Request $request, $response, $args)
    {
        return Response::success($this->usersService->update(
            $this->getParams($this, ['email' => ['type' => Params::STRING]])->email,
            $this->getParams($this, ['meta' => ['type' => Params::ARR]])->meta,
            $this->getParams($this, ['role_id' => ['type' => Params::STRING]])->role_id, $args['sitename']));
    }

     /**
        @api {delete} /:domain/users Delete User
        @apiPermission apikey
        @apiVersion 1.0.0
        @apiName DeleteUser
        @apiGroup Users
        @apiDescription Delete user from domain

        @apiParamExample {json} Input
        {
            "email": "user@domain.com"
        }

        @apiExample {shell} Curl
        curl "http://api-analytics.cloudwp.io/domain.com/users" \
        -X DELETE -H "Accept: application/json" \
        -H "X-CloudWP-Key: 0123456789abcdef0123456789abcdef" \
        -H "Authorization: Bearer jwt_token" \
        -H "Cache-Control: no-cache"

        @apiSuccessExample {json} Success response
        {
            "results": true
        }
      **/
    public function delete(Request $request, $response, $args)
    {
        return Response::success($this->usersService->delete($this->getParams($this, ['email' => ['type' => Params::STRING]])->email, $args['sitename']));
    }

}
