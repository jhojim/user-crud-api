<?php

namespace SRC\Action;

use SRC\Common\Action;
use SRC\Common\Response;
use Slim\Http\Request;
use SRC\Service\Roles as RolesService;

class Role extends Action
{
    protected $rolesService;

    /**
     * Role constructor.
     * @param RolesService $rolesService
     */
    public function __construct(RolesService $rolesService)
    {
        $this->rolesService = $rolesService;
    }

    /**
        @api {get} /role/{id} Get role
        @apiPermission apikey
        @apiVersion 1.0.0
        @apiName GetRole
        @apiGroup Role
        @apiDescription Returns role by id

        @apiExample {shell} Curl
        curl "http://api-analytics.cloudwp.io/domain.com/role/1" \
        -X GET -H "Accept: application/json" \
        -H "X-CloudWP-Key: 0123456789abcdef0123456789abcdef" \
        -H "Authorization: Bearer jwt_token" \
        -H "Cache-Control: no-cache"

        @apiSuccessExample {json} Success response
        {
            "results":
            {
                "name": "owner",
                "manage_users": "1",
                "manage_roles": "1",
                "meta": ["post_id", "advertiser_id", "utm_content", "browser_family"]
            }
        }
     **/
    public function get(Request $request, $response, $args)
    {
        return Response::success($this->rolesService->getByID($args['id']));
    }
}