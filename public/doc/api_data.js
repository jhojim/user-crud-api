define({ "api": [
  {
    "type": "post",
    "url": "/auth",
    "title": "User Authentication",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "User_Authentication",
    "group": "Auth0",
    "description": "<p>User Authentication</p>",
    "parameter": {
      "examples": [
        {
          "title": "Input",
          "content": "{\n    \"email\": \"user@domain.com\",\n    \"password\": \"yourpassword\"\n}",
          "type": "json"
        }
      ]
    },
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/auth\" \\\n-X POST -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"message\": \"Bearer yourBearerToken\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Auth.php",
    "groupTitle": "Auth0"
  },
  {
    "type": "post",
    "url": "/auth",
    "title": "User Authentication",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "User_Authentication",
    "group": "Auth0",
    "description": "<p>User Authentication</p>",
    "parameter": {
      "examples": [
        {
          "title": "Input",
          "content": "{\n    \"email\": \"user@domain.com\",\n    \"password\": \"yourpassword\"\n}",
          "type": "json"
        }
      ]
    },
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/auth\" \\\n-X POST -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"message\": \"Bearer yourBearerToken\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Auth.php",
    "groupTitle": "Auth0"
  },
  {
    "type": "get",
    "url": "/role/{id}",
    "title": "Get role",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "GetRole",
    "group": "Role",
    "description": "<p>Returns role by id</p>",
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/role/1\" \\\n-X GET -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"results\":\n    {\n        \"name\": \"owner\",\n        \"manage_users\": \"1\",\n        \"manage_roles\": \"1\",\n        \"meta\": [\"post_id\", \"advertiser_id\", \"utm_content\", \"browser_family\"]\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Role.php",
    "groupTitle": "Role"
  },
  {
    "type": "get",
    "url": "/role/{id}",
    "title": "Get role",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "GetRole",
    "group": "Role",
    "description": "<p>Returns role by id</p>",
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/role/1\" \\\n-X GET -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"results\":\n    {\n        \"name\": \"owner\",\n        \"manage_users\": \"1\",\n        \"manage_roles\": \"1\",\n        \"meta\": [\"post_id\", \"advertiser_id\", \"utm_content\", \"browser_family\"]\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Role.php",
    "groupTitle": "Role"
  },
  {
    "type": "post",
    "url": "/:domain/roles",
    "title": "Create Role",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "CreateRole",
    "group": "Roles",
    "description": "<p>Create role for domain</p>",
    "parameter": {
      "examples": [
        {
          "title": "Input",
          "content": "{\n    \"name\": \"owner\",\n    \"manage_users\": \"1\",\n    \"manage_roles\": \"1\",\n    \"meta\": [\"post_id\", \"advertiser_id\", \"utm_content\", \"browser_family\"],\n}",
          "type": "json"
        }
      ]
    },
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/roles\" \\\n-X POST -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"name\": \"owner\",\n    \"manage_users\": \"1\",\n    \"manage_roles\": \"1\",\n    \"meta\": [\"post_id\", \"advertiser_id\", \"utm_content\", \"browser_family\"],\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Roles.php",
    "groupTitle": "Roles"
  },
  {
    "type": "post",
    "url": "/:domain/roles",
    "title": "Create Role",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "CreateRole",
    "group": "Roles",
    "description": "<p>Create role for domain</p>",
    "parameter": {
      "examples": [
        {
          "title": "Input",
          "content": "{\n    \"name\": \"owner\",\n    \"manage_users\": \"1\",\n    \"manage_roles\": \"1\",\n    \"meta\": [\"post_id\", \"advertiser_id\", \"utm_content\", \"browser_family\"],\n}",
          "type": "json"
        }
      ]
    },
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/roles\" \\\n-X POST -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"name\": \"owner\",\n    \"manage_users\": \"1\",\n    \"manage_roles\": \"1\",\n    \"meta\": [\"post_id\", \"advertiser_id\", \"utm_content\", \"browser_family\"],\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Roles.php",
    "groupTitle": "Roles"
  },
  {
    "type": "delete",
    "url": "/:domain/roles/{id}",
    "title": "Delete Role",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "DeleteRole",
    "group": "Roles",
    "description": "<p>Delete role from domain</p>",
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/roles/1\" \\\n-X DELETE -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"results\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Roles.php",
    "groupTitle": "Roles"
  },
  {
    "type": "delete",
    "url": "/:domain/roles/{id}",
    "title": "Delete Role",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "DeleteRole",
    "group": "Roles",
    "description": "<p>Delete role from domain</p>",
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/roles/1\" \\\n-X DELETE -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"results\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Roles.php",
    "groupTitle": "Roles"
  },
  {
    "type": "put",
    "url": "/:domain/roles/{id}",
    "title": "Edit Role",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "EditRole",
    "group": "Roles",
    "description": "<p>Edit role for domain</p>",
    "parameter": {
      "examples": [
        {
          "title": "Input",
          "content": "{\n    \"name\": \"owner\",\n    \"manage_users\": \"1\",\n    \"manage_roles\": \"1\",\n    \"meta\": [\"post_id\", \"advertiser_id\", \"utm_content\", \"browser_family\"]\n}",
          "type": "json"
        }
      ]
    },
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/role/1\" \\\n-X PUT -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"name\": \"owner\",\n    \"manage_users\": \"1\",\n    \"manage_roles\": \"1\",\n    \"meta\": [\"post_id\", \"advertiser_id\", \"utm_content\", \"browser_family\"]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Roles.php",
    "groupTitle": "Roles"
  },
  {
    "type": "put",
    "url": "/:domain/roles/{id}",
    "title": "Edit Role",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "EditRole",
    "group": "Roles",
    "description": "<p>Edit role for domain</p>",
    "parameter": {
      "examples": [
        {
          "title": "Input",
          "content": "{\n    \"name\": \"owner\",\n    \"manage_users\": \"1\",\n    \"manage_roles\": \"1\",\n    \"meta\": [\"post_id\", \"advertiser_id\", \"utm_content\", \"browser_family\"]\n}",
          "type": "json"
        }
      ]
    },
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/role/1\" \\\n-X PUT -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"name\": \"owner\",\n    \"manage_users\": \"1\",\n    \"manage_roles\": \"1\",\n    \"meta\": [\"post_id\", \"advertiser_id\", \"utm_content\", \"browser_family\"]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Roles.php",
    "groupTitle": "Roles"
  },
  {
    "type": "get",
    "url": "/:domain/role/",
    "title": "Get roles",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "GetRoles",
    "group": "Roles",
    "description": "<p>Returns all roles for domain</p>",
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/roles\" \\\n-X GET -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"results\": [\n        {\n            \"name\": \"owner\",\n            \"manage_users\": \"1\",\n            \"manage_roles\": \"1\",\n            \"meta\": [\"post_id\", \"advertiser_id\", \"utm_content\", \"browser_family\"],\n        },\n        {\n            \"name\": \"admin\",\n            \"manage_users\": \"1\",\n            \"manage_roles\": \"0\",\n            \"meta\": [\"post_id\", \"advertiser_id\", \"utm_content\", \"browser_family\"],\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Roles.php",
    "groupTitle": "Roles"
  },
  {
    "type": "get",
    "url": "/:domain/role/",
    "title": "Get roles",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "GetRoles",
    "group": "Roles",
    "description": "<p>Returns all roles for domain</p>",
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/roles\" \\\n-X GET -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"results\": [\n        {\n            \"name\": \"owner\",\n            \"manage_users\": \"1\",\n            \"manage_roles\": \"1\",\n            \"meta\": [\"post_id\", \"advertiser_id\", \"utm_content\", \"browser_family\"],\n        },\n        {\n            \"name\": \"admin\",\n            \"manage_users\": \"1\",\n            \"manage_roles\": \"0\",\n            \"meta\": [\"post_id\", \"advertiser_id\", \"utm_content\", \"browser_family\"],\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Roles.php",
    "groupTitle": "Roles"
  },
  {
    "type": "get",
    "url": "/user",
    "title": "Get User",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "GetUser",
    "group": "User",
    "description": "<p>Returns user profile info</p>",
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/user\" \\\n-X GET -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"results\": {\n        \"email\": \"user@domain.com\",\n        \"domains\": [\n            {\n                \"domain\": \"domain.com\",\n                \"role_id\": \"1\",\n                \"role\":\n                {\n                    \"name\": \"owner\",\n                    \"manage_users\": \"1\",\n                    \"manage_roles\": \"1\",\n                    \"meta\": []\n                },\n                \"meta\": [\n                    {\n                        \"author\": \"owner\"\n                    },\n                    {\n                        \"meta_name\": \"meta_value\"\n                    }\n                ]\n            },\n            {\n                \"domain\": \"domain2.com\",\n                \"role_id\": \"2\",\n                \"role\":\n                {\n                    \"name\": \"owner\",\n                    \"manage_users\": \"1\",\n                    \"manage_roles\": \"1\",\n                    \"meta\": [\"post_id\", \"advertiser_id\", \"utm_content\", \"browser_family\"]\n                },\n                \"meta\": []\n            },\n            {\n                \"domain\": \"domain3.com\",\n                \"role_id\": \"3\",\n                \"role\":\n                {\n                    \"name\": \"owner\",\n                    \"manage_users\": \"1\",\n                    \"manage_roles\": \"1\",\n                    \"meta\": []\n                },\n                \"meta\": [\n                    {\n                        \"author\": \"owner\"\n                    },\n                    {\n                        \"meta_name\": \"meta_value\"\n                    }\n                ]\n            }\n        ]\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/User.php",
    "groupTitle": "User"
  },
  {
    "type": "get",
    "url": "/user",
    "title": "Get User",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "GetUser",
    "group": "User",
    "description": "<p>Returns user profile info</p>",
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/user\" \\\n-X GET -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"results\": {\n        \"email\": \"user@domain.com\",\n        \"domains\": [\n            {\n                \"domain\": \"domain.com\",\n                \"role_id\": \"1\",\n                \"role\":\n                {\n                    \"name\": \"owner\",\n                    \"manage_users\": \"1\",\n                    \"manage_roles\": \"1\",\n                    \"meta\": []\n                },\n                \"meta\": [\n                    {\n                        \"author\": \"owner\"\n                    },\n                    {\n                        \"meta_name\": \"meta_value\"\n                    }\n                ]\n            },\n            {\n                \"domain\": \"domain2.com\",\n                \"role_id\": \"2\",\n                \"role\":\n                {\n                    \"name\": \"owner\",\n                    \"manage_users\": \"1\",\n                    \"manage_roles\": \"1\",\n                    \"meta\": [\"post_id\", \"advertiser_id\", \"utm_content\", \"browser_family\"]\n                },\n                \"meta\": []\n            },\n            {\n                \"domain\": \"domain3.com\",\n                \"role_id\": \"3\",\n                \"role\":\n                {\n                    \"name\": \"owner\",\n                    \"manage_users\": \"1\",\n                    \"manage_roles\": \"1\",\n                    \"meta\": []\n                },\n                \"meta\": [\n                    {\n                        \"author\": \"owner\"\n                    },\n                    {\n                        \"meta_name\": \"meta_value\"\n                    }\n                ]\n            }\n        ]\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/User.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/:domain/users",
    "title": "Create User",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "CreateUser",
    "group": "Users",
    "description": "<p>Create user for domain</p>",
    "parameter": {
      "examples": [
        {
          "title": "Input",
          "content": "{\n    \"email\": \"user@domain.com\",\n    \"role_id\": \"1\",\n    \"meta\": [\n        {\n            \"author\": \"admin\"\n        },\n        {\n            \"meta_name\": \"meta_value\"\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/users\" \\\n-X POST -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"results\":\n    {\n        \"email\": \"user@domain.com\",\n        \"domain\": \"domain.com\",\n        \"role_id\": \"1\",\n        \"role\":\n        {\n            \"name\": \"owner\",\n            \"manage_users\": \"1\",\n            \"manage_roles\": \"1\",\n            \"meta\": []\n        },\n        \"meta\": [\n            {\n                \"author\": \"owner\"\n            },\n            {\n                \"meta_name\": \"meta_value\"\n            }\n        ]\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Users.php",
    "groupTitle": "Users"
  },
  {
    "type": "post",
    "url": "/:domain/users",
    "title": "Create User",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "CreateUser",
    "group": "Users",
    "description": "<p>Create user for domain</p>",
    "parameter": {
      "examples": [
        {
          "title": "Input",
          "content": "{\n    \"email\": \"user@domain.com\",\n    \"role_id\": \"1\",\n    \"meta\": [\n        {\n            \"author\": \"admin\"\n        },\n        {\n            \"meta_name\": \"meta_value\"\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/users\" \\\n-X POST -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"results\":\n    {\n        \"email\": \"user@domain.com\",\n        \"domain\": \"domain.com\",\n        \"role_id\": \"1\",\n        \"role\":\n        {\n            \"name\": \"owner\",\n            \"manage_users\": \"1\",\n            \"manage_roles\": \"1\",\n            \"meta\": []\n        },\n        \"meta\": [\n            {\n                \"author\": \"owner\"\n            },\n            {\n                \"meta_name\": \"meta_value\"\n            }\n        ]\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Users.php",
    "groupTitle": "Users"
  },
  {
    "type": "delete",
    "url": "/:domain/users",
    "title": "Delete User",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "DeleteUser",
    "group": "Users",
    "description": "<p>Delete user from domain</p>",
    "parameter": {
      "examples": [
        {
          "title": "Input",
          "content": "{\n    \"email\": \"user@domain.com\"\n}",
          "type": "json"
        }
      ]
    },
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/users\" \\\n-X DELETE -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"results\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Users.php",
    "groupTitle": "Users"
  },
  {
    "type": "delete",
    "url": "/:domain/users",
    "title": "Delete User",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "DeleteUser",
    "group": "Users",
    "description": "<p>Delete user from domain</p>",
    "parameter": {
      "examples": [
        {
          "title": "Input",
          "content": "{\n    \"email\": \"user@domain.com\"\n}",
          "type": "json"
        }
      ]
    },
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/users\" \\\n-X DELETE -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"results\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Users.php",
    "groupTitle": "Users"
  },
  {
    "type": "put",
    "url": "/:domain/users",
    "title": "Edit User",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "EditUser",
    "group": "Users",
    "description": "<p>Edit user for domain</p>",
    "parameter": {
      "examples": [
        {
          "title": "Input",
          "content": "{\n    \"email\": \"user@domain.com\",\n    \"role_id\": \"1\",\n    \"meta\": [\n        {\n            \"author\": \"admin\"\n        },\n        {\n            \"meta_name\": \"meta_value\"\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/users\" \\\n-X PUT -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"results\":\n    {\n        \"email\": \"user@domain.com\",\n        \"domain\": \"domain.com\",\n        \"role_id\": \"1\",\n        \"role\":\n        {\n            \"name\": \"owner\",\n            \"manage_users\": \"1\",\n            \"manage_roles\": \"1\",\n            \"meta\": [\"post_id\", \"advertiser_id\", \"utm_content\", \"browser_family\"]\n        },\n        \"meta\": [\n            {\n                \"author\": \"admin\"\n            },\n            {\n                \"meta_name\": \"meta_value2\"\n            }\n        ]\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Users.php",
    "groupTitle": "Users"
  },
  {
    "type": "put",
    "url": "/:domain/users",
    "title": "Edit User",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "EditUser",
    "group": "Users",
    "description": "<p>Edit user for domain</p>",
    "parameter": {
      "examples": [
        {
          "title": "Input",
          "content": "{\n    \"email\": \"user@domain.com\",\n    \"role_id\": \"1\",\n    \"meta\": [\n        {\n            \"author\": \"admin\"\n        },\n        {\n            \"meta_name\": \"meta_value\"\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/users\" \\\n-X PUT -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n    \"results\":\n    {\n        \"email\": \"user@domain.com\",\n        \"domain\": \"domain.com\",\n        \"role_id\": \"1\",\n        \"role\":\n        {\n            \"name\": \"owner\",\n            \"manage_users\": \"1\",\n            \"manage_roles\": \"1\",\n            \"meta\": [\"post_id\", \"advertiser_id\", \"utm_content\", \"browser_family\"]\n        },\n        \"meta\": [\n            {\n                \"author\": \"admin\"\n            },\n            {\n                \"meta_name\": \"meta_value2\"\n            }\n        ]\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Users.php",
    "groupTitle": "Users"
  },
  {
    "type": "get",
    "url": "/:domain/users",
    "title": "Get Users",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "GetUsers",
    "group": "Users",
    "description": "<p>Returns all users with permissions for domain</p>",
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/users\" \\\n-X GET -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": " {\n     \"results\":\n    {\n        \"email\": \"user@domain.com\",\n        \"role_id\": \"1\",\n        \"role\":\n        {\n            \"name\": \"owner\",\n            \"manage_users\": \"1\",\n            \"manage_roles\": \"1\",\n            \"meta\": []\n        },\n        \"meta\": [\n            {\n                \"author\": \"owner\"\n            },\n            {\n                \"meta_name\": \"meta_value\"\n            }\n        ]\n    },\n    {\n        \"email\": \"user2@domain.com\",\n        \"role_id\": \"2\",\n        \"role\":\n        {\n            \"name\": \"owner\",\n            \"manage_users\": \"1\",\n            \"manage_roles\": \"1\",\n            \"meta\": []\n        },\n        \"meta\": []\n    },\n    {\n        \"email\": \"user3@domain.com\",\n        \"role_id\": \"3\",\n        \"role\":\n        {\n            \"name\": \"owner\",\n            \"manage_users\": \"1\",\n            \"manage_roles\": \"1\",\n            \"meta\": []\n        },\n        \"meta\": [\n            {\n                \"author\": \"admin\"\n            },\n            {\n                \"meta_name\": \"meta_value\"\n            }\n        ]\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Users.php",
    "groupTitle": "Users"
  },
  {
    "type": "get",
    "url": "/:domain/users",
    "title": "Get Users",
    "permission": [
      {
        "name": "apikey"
      }
    ],
    "version": "1.0.0",
    "name": "GetUsers",
    "group": "Users",
    "description": "<p>Returns all users with permissions for domain</p>",
    "examples": [
      {
        "title": "Curl",
        "content": "curl \"http://api-analytics.cloudwp.io/domain.com/users\" \\\n-X GET -H \"Accept: application/json\" \\\n-H \"X-CloudWP-Key: 0123456789abcdef0123456789abcdef\" \\\n-H \"Authorization: Bearer jwt_token\" \\\n-H \"Cache-Control: no-cache\"",
        "type": "shell"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": " {\n     \"results\":\n    {\n        \"email\": \"user@domain.com\",\n        \"role_id\": \"1\",\n        \"role\":\n        {\n            \"name\": \"owner\",\n            \"manage_users\": \"1\",\n            \"manage_roles\": \"1\",\n            \"meta\": []\n        },\n        \"meta\": [\n            {\n                \"author\": \"owner\"\n            },\n            {\n                \"meta_name\": \"meta_value\"\n            }\n        ]\n    },\n    {\n        \"email\": \"user2@domain.com\",\n        \"role_id\": \"2\",\n        \"role\":\n        {\n            \"name\": \"owner\",\n            \"manage_users\": \"1\",\n            \"manage_roles\": \"1\",\n            \"meta\": []\n        },\n        \"meta\": []\n    },\n    {\n        \"email\": \"user3@domain.com\",\n        \"role_id\": \"3\",\n        \"role\":\n        {\n            \"name\": \"owner\",\n            \"manage_users\": \"1\",\n            \"manage_roles\": \"1\",\n            \"meta\": []\n        },\n        \"meta\": [\n            {\n                \"author\": \"admin\"\n            },\n            {\n                \"meta_name\": \"meta_value\"\n            }\n        ]\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/dev/projects/user-crud-api/src/Action/Users.php",
    "groupTitle": "Users"
  }
] });
