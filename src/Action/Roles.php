<?php

namespace SRC\Action;

use SRC\Common\Action;
use SRC\Common\Response;
use Slim\Http\Request;
use SRC\Common\Params;
use SRC\CurrentUser;
use SRC\Service\Roles as RolesService;

class Roles extends Action
{

    protected $rolesService;
    protected $currentUser;
    protected $params = [
        'name' => ['type' => Params::STRING],
        'manage_users' => ['type' => Params::NUMBER],
        'manage_roles' => ['type' => Params::NUMBER],
        'meta' => ['type' => Params::ARR, 'default' => []],
    ];

    /**
     * Roles constructor.
     * @param RolesService $rolesService
     * @param CurrentUser $currentUser
     */
    public function __construct(
        RolesService $rolesService,
        CurrentUser $currentUser
    ) {
        $this->rolesService = $rolesService;
        $this->currentUser = $currentUser;
        $this->currentUser->canManageRoles();
    }

    /**
        @api {get} /:domain/role/ Get roles
        @apiPermission apikey
        @apiVersion 1.0.0
        @apiName GetRoles
        @apiGroup Roles
        @apiDescription Returns all roles for domain

        @apiExample {shell} Curl
        curl "http://api-analytics.cloudwp.io/domain.com/roles" \
        -X GET -H "Accept: application/json" \
        -H "X-CloudWP-Key: 0123456789abcdef0123456789abcdef" \
        -H "Authorization: Bearer jwt_token" \
        -H "Cache-Control: no-cache"

        @apiSuccessExample {json} Success response
        {
            "results": [
                {
                    "name": "owner",
                    "manage_users": "1",
                    "manage_roles": "1",
                    "meta": ["post_id", "advertiser_id", "utm_content", "browser_family"],
                },
                {
                    "name": "admin",
                    "manage_users": "1",
                    "manage_roles": "0",
                    "meta": ["post_id", "advertiser_id", "utm_content", "browser_family"],
                }
            ]
        }
     **/
    public function get(Request $request, $response, $args)
    {
        return Response::success($this->rolesService->getByDomain($args['sitename']));
    }

    /**
        @api {post} /:domain/roles Create Role
        @apiPermission apikey
        @apiVersion 1.0.0
        @apiName CreateRole
        @apiGroup Roles
        @apiDescription Create role for domain

        @apiParamExample {json} Input
        {
            "name": "owner",
            "manage_users": "1",
            "manage_roles": "1",
            "meta": ["post_id", "advertiser_id", "utm_content", "browser_family"],
        }

        @apiExample {shell} Curl
        curl "http://api-analytics.cloudwp.io/domain.com/roles" \
        -X POST -H "Accept: application/json" \
        -H "X-CloudWP-Key: 0123456789abcdef0123456789abcdef" \
        -H "Authorization: Bearer jwt_token" \
        -H "Cache-Control: no-cache"

        @apiSuccessExample {json} Success response
        {
            "name": "owner",
            "manage_users": "1",
            "manage_roles": "1",
            "meta": ["post_id", "advertiser_id", "utm_content", "browser_family"],
        }
     **/
    public function post(Request $request, $response, $args)
    {
        return Response::success($this->rolesService->create($this->getParams($this,
            ['name' => ['type' => Params::STRING]])->name,
            $this->getParams($this, ['manage_users' => ['type' => Params::STRING]])->manage_users,
            $this->getParams($this, ['manage_roles' => ['type' => Params::STRING]])->manage_roles,
            $this->getParams($this, ['meta' => ['type' => Params::ARR]])->meta,
            $args['sitename']));
    }

     /**
        @api {put} /:domain/roles/{id} Edit Role
        @apiPermission apikey
        @apiVersion 1.0.0
        @apiName EditRole
        @apiGroup Roles
        @apiDescription Edit role for domain

        @apiParamExample {json} Input
        {
            "name": "owner",
            "manage_users": "1",
            "manage_roles": "1",
            "meta": ["post_id", "advertiser_id", "utm_content", "browser_family"]
        }

        @apiExample {shell} Curl
        curl "http://api-analytics.cloudwp.io/domain.com/role/1" \
        -X PUT -H "Accept: application/json" \
        -H "X-CloudWP-Key: 0123456789abcdef0123456789abcdef" \
        -H "Authorization: Bearer jwt_token" \
        -H "Cache-Control: no-cache"

        @apiSuccessExample {json} Success response
        {
            "name": "owner",
            "manage_users": "1",
            "manage_roles": "1",
            "meta": ["post_id", "advertiser_id", "utm_content", "browser_family"]
        }
      **/
    public function put(Request $request, $response, $args)
    {
        return Response::success($this->rolesService->update($this->getParams($this,
            ['name' => ['type' => Params::STRING]])->name,
            $this->getParams($this, ['manage_users' => ['type' => Params::STRING]])->manage_users,
            $this->getParams($this, ['manage_roles' => ['type' => Params::STRING]])->manage_roles,
            $this->getParams($this, ['meta' => ['type' => Params::ARR]])->meta,
            $args['sitename'], $args['id']));
    }

     /**
        @api {delete} /:domain/roles/{id} Delete Role
        @apiPermission apikey
        @apiVersion 1.0.0
        @apiName DeleteRole
        @apiGroup Roles
        @apiDescription Delete role from domain

        @apiExample {shell} Curl
        curl "http://api-analytics.cloudwp.io/domain.com/roles/1" \
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
        return Response::success($this->rolesService->delete($args['id']));
    }

}